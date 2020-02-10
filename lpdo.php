<?php
class lpdo
{
    public function constructeur($host, $username, $password, $db)
    {
        $conn = mysqli_connect($host, $username, $password, $db);
        echo "connected<br>";
    }

    public function connect($host, $username, $password, $db)
    {
        $conn = mysqli_connect($host, $username, $password, $db);
        $var = mysqli_close($conn);
        if ($conn == true) {
            $conn = mysqli_connect($host, $username, $password, $db);
            echo "disconnected<br>";
        }
    }

    public function destructeur($conn)
    {
        $var = mysqli_close($conn);
    }

    public function close($conn)
    {
        $var = mysqli_close($conn);
    }

    public function execute($sql, $host, $username, $password, $db)
    {
        $conn = mysqli_connect($host, $username, $password, $db);
        $result = mysqli_query($conn, $sql);
        return [$result];
    }

    public function getLastQuery($host, $username, $password, $db)
    {
        $conn = mysqli_connect($host, $username, $password, $db);
        $result = mysqli_info($conn);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getLastResult($host, $username, $password, $db)
    {
        $conn = mysqli_connect($host, $username, $password, $db);
        $sql = "SELECT deqs.last_execution_time AS [Time], dest.text AS [Query], dest.* FROM sys.dm_exec_query_stats AS deqs CROSS APPLY sys.dm_exec_sql_text(deqs.sql_handle) AS dest WHERE dest.dbid = DB_ID('msdb') ORDER BY deqs.last_execution_time DESC";
        $result = mysqli_query($conn, $sql);
        if (!empty($result)) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function getTables($host, $username, $password, $db)
    {
        $conn = mysqli_connect($host, $username, $password, $db);
        $sql = "SELECT `TABLE_NAME` FROM `TABLES` WHERE `TABLE_SCHEMA` = 'poo'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_all($query);
        var_dump($result);
        return $result;
    }

    public function getFields($table, $host, $username, $password, $db)
    {
        $conn = mysqli_connect($host, $username, $password, $db);
        $request = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='" . $table . "'";
        $query = mysqli_query($conn, $request);
        $result = mysqli_fetch_all($query);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
}
