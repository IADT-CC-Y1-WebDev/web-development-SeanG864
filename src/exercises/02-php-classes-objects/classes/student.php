<?php 

class Student1 {
    public $name;
    public $number; 
}

class Student2 {
    protected $name;
    protected $number; 

    public function __construct($name, $number){
        $this->name = $name;
        $this->number = $number;

        // echo "Creating student: $this->name";
        
        try {
             if (empty($this->number)) {
                 throw new Exception("Student number cannot be empty");
        }
            // echo $this->name;
            echo '<br>';
            echo $this->number;
        }

        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function __toString(){
        $format = "Student: %s(%s)";
        return sprintf($format, $this->name, $this->number);
    }
}

?>