<?php
    class Department
    {
        public function __construct(private string $name, private $Employees)
        {
        }
        public function get_name(): string{
            return $this->name;
        }
        public function get_count_employee(): int
        {
            return count($this->Employees);
        }
        public function total_salary(): int
        {
            $total_salary = 0;
            foreach ($this->Employees as $emp) {
                $total_salary = $total_salary + $emp->get_salary();
            }
            return $total_salary;
        }
        public function beautiful_string()
        {
            echo 'Name: '.$this->get_name() . "\n";
            foreach ($this->Employees as $emp) {
                echo $emp->beautiful_string();
            }
        }
    }
?>