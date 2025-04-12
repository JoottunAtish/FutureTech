<?php
require_once("DBController.php");

class product
{
    public function getAllProduct()
    {
        $query = "select * from products;";
        $controller = new DBController();
        $res = $controller->executeSelectQuery($query);
        $out = array("success" => 1, "result" => $res);
        return $out;
    }

    public function getDeals($discount)
    {
        $val = 0;
        if (!empty($discount)){
            $val = $discount;
        }
        $query = "select * from products WHERE Discount = '" . addslashes($val) . "';";
        $controller = new DBController();
        $res = $controller->executeSelectQuery($query);
        if (!empty($res)) {
            $out = array("success" => 1, "message" => "No error",  "result" => $res);
        } else {
            $out = array("success" => 0, "message" => "An error has occurred", "result" => $res);
        }
        return $out;
    }

    public function getPreBuilt()
    {
        $query = "select * from products WHERE Category = '2';";
        $controller = new DBController();
        $res = $controller->executeSelectQuery($query);
        if (!empty($res)) {
            $out = array("success" => 1, "message" => "No error", "result" => $res);
        } else {
            $out = array("success" => 0, "message" => "An error has occurred", "result" => $res);
        }
        return $out;
    }

    public function getParts()
    {
        $query = "select * from products WHERE Category = '1';";
        $controller = new DBController();
        $res = $controller->executeSelectQuery($query);
        if (!empty($res)) {
            $out = array("success" => 1, "message" => "No error", "result" => $res);
        } else {
            $out = array("success" => 0, "message" => "An error has occurred", "result" => $res);
        }
        return $out;
    }

    public function getAccesssory()
    {
        $query = "select * from products WHERE Category = '3';";
        $controller = new DBController();
        $res = $controller->executeSelectQuery($query);
        if (!empty($res)) {
            $out = array("success" => 1, "message" => "No error", "result" => $res);
        } else {
            $out = array("success" => 0, "message" => "An error has occurred", "result" => $res);
        }
        return $out;
    }

    public function getSearchProduct($keyword)
    {
        $keywords = explode(' ', $keyword);
        $query = "SELECT * FROM products WHERE ";
        $conditions = [];
        $params = [];

        foreach ($keywords as $word) {
            $conditions[] = "(productName LIKE ? OR Description LIKE ?)";
            $params[] = '%' . $word . '%';
            $params[] = '%' . $word . '%';
        }

        $query .= implode(' AND ', $conditions);
        $controller = new DBController();
        $res = $controller->executeSelectQuery($query, $params);

        if (!empty($res)) {
            $out = array("success" => 1, "message" => "No error", "result" => $res);
        } else {
            $out = array("success" => 0, "message" => "An error has occurred", "result" => $res);
        }
        return $out;
    }
}
