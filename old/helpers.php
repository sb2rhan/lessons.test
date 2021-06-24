<?php

/**
 * Wrapper function of mysqli_connect with error checking
 */
function sqlConnect(?string $hostname = null, ?string $username = null, ?string $password = null,
                    ?string $database = null, ?int $port = null, ?string $socket = null): bool|mysqli|null
{
    $connection = mysqli_connect($hostname, $username, $password, $database, $port, $socket);

    # error checker
    if ($code = mysqli_connect_errno()) {
        $message = mysqli_connect_error();
        die("MySQL connection error with code [{$code}]: $message");
    }

    return $connection;
}

/**
 * Executes the given query
 */
function sqlQuery($connection, string $query): bool|array
{
    $res = mysqli_query($connection, $query);

    if ($code = mysqli_errno($connection)) {
        $message = mysqli_error($connection);
        die("MySQL query error with code [{$code}]: $message");
    }

    if (is_bool($res)) return $res;

    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

/**
 * Closes the active connection
 */
function sqlClose($connection) {
    if ($connection) mysqli_close($connection);
}

function whereBuilderReadyStatements(array $where): ?string
{
    if (empty($where)) return null;

    return 'where ' . implode(' and ', $where);
}

function whereBuilderKVData(array $raw_where): ?string {
    if (empty($raw_where)) return null;

    $col_values = [];
    foreach ($raw_where as $col => $val) {
        if (is_string($val))
            $col_values[] = "$col = '$val'";
        else
            $col_values[] = "$col = $val";
    }

    return 'where ' . implode(' and ', $col_values);
}

function sqlSelect($connection, string $table, $cols = ['*'], array $where = []): bool|array
{
    if (!is_array($cols))
        $cols = [$cols];

    $where = whereBuilderReadyStatements($where);

    $cols = implode(',', $cols);
    return sqlQuery($connection, "select {$cols} from {$table} {$where};");
}

function sqlCount($connection, string $table, array $where = []): array|bool|int
{
    $where = whereBuilderReadyStatements($where);

    $res = sqlQuery($connection, "select count(*) from {$table} {$where}");

    if (!is_array($res))
        return $res;

    return (int)$res[0]['count(*)'];
}


/*
 * TODO: Homework 6 functions
 */
function mysqlInsert($connection, string $table, array $data): bool|array
{
    $cols = implode(', ', array_keys($data));
    $raw_values = array_map(function ($el) {
        if (is_string($el))
            return "'{$el}'";
        return "{$el}";
    }, array_values($data));
    $values = implode(', ', array_values($raw_values));

    return sqlQuery($connection, "insert into {$table} ({$cols}) values ({$values});");
}

function mysqlUpdate($connection, string $table, array $where, array $data): bool|array
{
    $col_values = [];
    foreach ($data as $col => $val) {
        if (is_string($val))
            $col_values[] = "$col='$val'";
        else
            $col_values[] = "$col=$val";
    }
    $query = "update {$table} set " . implode(', ', $col_values);

    $where_part = whereBuilderKVData($where);
    $query .= " $where_part;";

    return sqlQuery($connection, $query);
}

function mysqlDelete($connection, string $table, array $where): bool|array
{
    $where_part = whereBuilderKVData($where);
    $query = "delete from {$table} {$where_part};";
    return sqlQuery($connection, $query);
}