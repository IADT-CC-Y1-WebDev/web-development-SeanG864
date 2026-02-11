<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/05-functions.php">View Example &rarr;</a>
    </div>

    <h1>Functions Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Temperature Converter</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called celsiusToFahrenheit() that takes a Celsius temperature as a parameter and returns the Fahrenheit equivalent. Formula: F = (C × 9/5) + 32. Test it with a few values.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function celsiusToFahrenheit($cTemp) {
            $fTemp = null;
            $fTemp = ($cTemp*9/5) + 32;
            if ($cTemp == 0) {
                return 0;
            }
            else {
                return $fTemp;
            }
        }
        $cTemp = null;
        $fTemp = celsiusToFahrenheit($cTemp);
        echo "$cTemp in farenheit is: $fTemp";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Rectangle Area</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called calculateRectangleArea() that takes width
         and height as parameters. It should return the area. If only one 
         parameter is provided, assume it's a square (both dimensions equal).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function calculateRectangleArea($width, $height) {
            if ($height == null) {
                return $width * $width;
            }
            else {
                return $width * $height;
            }
        }
        $width = null;
        $height = null;
        $area = calculateRectangleArea($width, $height);
        echo "The area is $area";
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Even or Odd</h2>
    <p>
        <strong>Task:</strong>
        Create a function called checkEvenOdd() that takes a number and returns 
        "Even" if the number is even, or "Odd" if it's odd. Use the modulo 
        operator (%).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function checkEvenOdd($num) {
            if ($num == null) {
                return null;
            }
            else if ($num % 2 == 0) {
                return "Even";
            }
            else {
                return "Odd";
            }
        }
        $num = null;
        $check = checkEvenOdd($num);
        echo "Your number is: $check";
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Array Statistics</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called getArrayStats() that takes an array of numbers 
        and returns an array with three values: minimum, maximum, and average. 
        Use array destructuring to display the results.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function getArrayStats($numbers) {
            
            // This does work as well

            // if ($numbers[0] < $numbers[1] and $numbers[0] < $numbers[2]) {
            //     $minimum = $numbers[0];
            //     if ($numbers[1] < $numbers[2]) {
            //         $maximum = $numbers[2];
            //     }
            //     else {
            //         $maximum = $numbers[1];
            //     }
            // }
            // else if ($numbers[1] < $numbers[0] and $numbers[1] < $numbers[2]) {
            //     $minimum = $numbers[1];
            //     if ($numbers[0] < $numbers[2]) {
            //         $maximum = $numbers[2];
            //     }
            //     else {
            //         $maximum = $numbers[0];
            //     }
            // }
            // else if ($numbers[2] < $numbers[0] and $numbers[2] < $numbers[1]) {
            //     $minimum = $numbers[2];
            //     if ($numbers[0] < $numbers[1]) {
            //         $maximum = $numbers[1];
            //     }
            //     else {
            //         $maximum = $numbers[0];
            //     }
            // }

            
            // $average = $numbers[0] + $numbers[1] + $numbers[2] / count($numbers);

            $minimum = min($numbers);
            $maximum = max($numbers);
            $average = array_sum($numbers) / count($numbers);
            $stats = [$minimum, $maximum, $average];
            return $stats;
        }

        $nums = [3,4,15];
        [$min, $max, $avg] = getArrayStats($nums);
        echo "<p>The minimum of this list is: $min</p><p>The maximum of this list is: $max</p>"
        ?>
    </div>

</body>
</html>
