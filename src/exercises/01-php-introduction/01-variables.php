<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/01-variables.php">View Example &rarr;</a>
    </div>

    <h1>Variables Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Personal Information</h2>
    <p>
        <strong>Task:</strong> 
        Create variables for your first name, last name, age, and city. 
        Then output a sentence using these variables that says "My name 
        is [first] [last], I am [age] years old and I live in [city]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $firstName = "Sean";
        $lastName = "Gildea";

        echo "My name is $firstName $lastName";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Shopping Calculator</h2>
    <p>
        <strong>Task:</strong> 
        Create variables for three product prices and their quantities. 
        Calculate the subtotal for each product (price × quantity), then 
        calculate the total cost. Apply a 10% discount and display the 
        final price.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $appleA = 4;
        $orangeA = 6;
        $bananaA = 5;

        $appleP = 0.80;
        $orangeP = 0.60;
        $bananaP = 0.70;

        $appleT = $appleA * $appleP;
        $orangeT = $orangeA * $orangeP;
        $bananaT = $bananaA * $bananaP;

        $fTotal = $appleT + $orangeT + $bananaT;
        $fPrice = $fTotal - ($fTotal / 10);

        echo "The final discounted price is: $fPrice";
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: User Status</h2>
    <p>
        <strong>Task:</strong> 
        Create boolean variables for isStudent, hasDiscount, and isPremiumMember. 
        Use the ternary operator to display "Yes" or "No" for each status.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $isStudent = true;
        $hasDiscount = true;
        $isPremiumMember = false;

        echo "Is a student: " . ($isStudent ? "Yes" : "No") . "<br>";
        echo "Has a discount: " . ($hasDiscount ? "Yes" : "No") . "<br>";
        echo "Is a premium member: " . ($isPremiumMember ? "Yes" : "No");
        
        ?>
    </div>

</body>
</html>
