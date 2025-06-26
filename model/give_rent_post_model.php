<?php

class GiveRentPostModel {

    private $conn;
 
    public function __construct(mysqli $conn) {

        $this->conn = $conn;

    }
 
    /**

     * Save a new car listing.

     *

     * @param int    $seller_id

     * @param string $car_name

     * @param string $car_model

     * @param string $description

     * @param float  $price_per_day

     * @param string $image_name   — the filename stored in /uploads

     * @return bool

     */

    public function saveCar($seller_id, $car_name, $car_model, $description, $price_per_day, $image_name) {

        $sql = "INSERT INTO cars 

                  (seller_id, car_name, car_model, price_per_day, description, image, created_at)

                VALUES (?, ?, ?, ?, ?, ?, NOW())";
 
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {

            return false;

        }
 
        // i = integer, s = string, d = double

        $stmt->bind_param(

            "issdss",

            $seller_id,

            $car_name,

            $car_model,

            $price_per_day,

            $description,

            $image_name

        );
 
        return $stmt->execute();

    }

}

?>

 