<?php

class Model
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "stay";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (\Throwable $th) {
            //throw $th;
            echo "Connection error " . $th->getMessage();
        }
    }

    // Fetch Standard

    public function fetch_std()
    {
        $data = [];

        $query = "SELECT DISTINCT `type` FROM `logement`";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Fetch Result

    public function fetch_res()
    {
        $data = [];

        $query = "SELECT DISTINCT `adult` FROM `logement`";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Fetch Records

    public function fetch()
    {
        $data = [];

        $query = "SELECT * FROM logement";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Filter Standard and Result

    public function fetch_filter($std, $res)
    {
        $data = [];

        $query = "SELECT * FROM logement WHERE `type` = '$std' AND adult = '$res' ";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Filter Standard

    public function fetch_std_filter($std)
    {
        $data = [];

        $query = "SELECT * FROM logement WHERE standard = '$std'";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Filter Result

    public function fetch_res_filter($res)
    {
        $data = [];

        $query = "SELECT * FROM logement WHERE adult = '$res'";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }
}
