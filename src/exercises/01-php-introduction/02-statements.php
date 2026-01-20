<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statements Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/02-statements.php">View Example &rarr;</a>
    </div>

    <h1>Statements Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Age Classifier</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for age. Use if/else statements to classify and 
        display the age group: "Child" (0-12), "Teenager" (13-19), "Adult" 
        (20-64), or "Senior" (65+).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $age = rand(1,100);

        if ($age > 0 and $age <= 12) {
            echo "You are a child";
        }

        if ($age >= 13 and $age <= 19) {
            echo "You are a teenager";
        }

        if ($age >= 20 and $age <= 64) {
            echo "You are an adult";
        }

        if ($age >= 65) {
            echo "You are a senior";
        }
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Day of the Week</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for the day of the week (use a number 1-7). Use 
        a switch statement to display whether it's a "Weekday" or "Weekend", 
        and the day name.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $day = rand(1,7);
        switch (true) {
            case ($day == 1):
                echo "<p>Monday, Weekday</p>";
                break;
            case ($day == 2):
                echo "<p>Tuesday, Weekday</p>";
                break;
            case ($day == 3):
                echo "<p>Wednesday, Weekday</p>";
                break;
            case ($day == 4):
                echo "<p>Thursday, Weekday</p>";
                break;
            case ($day == 5):
                echo "<p>Friday, Weekday</p>";
                break;
            case ($day == 6):
                echo "<p>Saturday, Weekend</p>";
                break;
            case ($day == 7):
                echo "<p>Sunday, Weekend</p>";
                break;        
            
}
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Multiplication Table</h2>
    <p>
        <strong>Task:</strong> 
        Use a for loop to create a multiplication table for a number of your 
        choice (1 through 10). Display each line in the format "X × Y = Z".
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $num = 8;
        for ($i = 1;$i <= 12;$i++) {
            $total = 8 * $i;
            echo "<p> 8 x $i = $total";
            $num = 8;
        }
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Countdown Timer</h2>
    <p>
        <strong>Task:</strong> 
        Create a countdown from 10 to 0 using a while loop. Display each number, 
        and when you reach 0, display "Blast off!"
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        ?>
    </div>

</body>
</html>
