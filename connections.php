<?php

define("DB_HOST", "");
define("DB_USERNAME", "");
define("DB_PASSWORD", "");
define("DB_DATABASE", "autorand");

function conn()
{
    $servername     = DB_HOST;
    $username       = DB_USERNAME;
    $password       = DB_PASSWORD;
    $dbname         = DB_DATABASE;

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    /* change character set to utf8 */
    if (!mysqli_set_charset($conn, "utf8")) {
        printf("Error loading character set utf8: %s\n", mysqli_error($conn));
        exit();
    } else {
        printf("Current character set: %s\n", mysqli_character_set_name($conn));
    }


    // Check connection
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}


function selectWhere($table, $column=null, $value=null, $orderBy=null, $orderValue = "DESC")
{
    $conn = conn();

    if ($column == null)
    {
        if($orderBy != null)
        {
            $sql    = "SELECT * FROM `".$table."` ORDER BY {$orderBy} {$orderValue}";
        }
        else
        {
            $sql    = "SELECT * FROM `".$table."`";
        }
    }
    else
    {
        if($orderBy != null)
        {
            $sql    = "SELECT * FROM `".$table."` WHERE `".$column."` = '".$value."'  ORDER BY {$orderBy} {$orderValue}";
        }
        else
        {
            $sql    = "SELECT * FROM `".$table."` WHERE `".$column."` = '".$value."'";
        }
    }

    $result     = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
        if (mysqli_num_rows($result) == 1)
        {
            $result         = $result->fetch_assoc();
            return $result;
        }
        else
        {
            // output data of each row
            while($data = $result->fetch_assoc())  // foreach continents perform the function below
            {
                $return[] = $data;
            }
            return $return;
        }

        // return $result->fetch_assoc();
    }
    else
    {
        return ["No records found"];
    }
}

function selectSql($sql)
{
    $conn       = conn();
    $result     = mysqli_query($conn, $sql);

    if(!is_bool($result))
    {
        if (mysqli_num_rows($result) > 0)
        {
            if (mysqli_num_rows($result) == 1)
            {
                $result         = $result->fetch_assoc();
                return $result;
            }
            else
            {
                $return     = [];
                // output data of each row
                while($data = $result->fetch_assoc())  // foreach results, push them to the return array
                {
                    $return[] = $data;
                }
                return $return;
            }

        }
        else
        {
            return false;
            // returns false if no data was found
        }
    }
    elseif($result == true)
    {
        return true;
    }
    else
    {
        var_dump( $result,$sql,"There's an issue with your Sql query " ,  mysqli_error($conn));

    }
}

function multiSql($sql)
{
    $conn       = conn();
    $result     = mysqli_query($conn, $sql);

    if(!is_bool($result))
    {
        if (mysqli_num_rows($result) > 0)
        {
            if (mysqli_num_rows($result) == 1)
            {
                $return         = [];
                $data           = $result->fetch_assoc();
                $return[]       = $data;
                return $return;
            }
            else
            {
                $return     = [];
                // output data of each row
                while($data = $result->fetch_assoc())  // foreach results, push them to the return array
                {
                    $return[] = $data;
                }
                return $return;
            }

        }
        else
        {
            return false;
            // returns false if no data was found
        }
    }
    elseif($result == true)
    {
        return true;
    }
    else
    {
        var_dump($result);
        //die($sql);
    }
}

function sqlInsert($sql)
{
    $conn       = conn();

    if (mysqli_query($conn, $sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}
