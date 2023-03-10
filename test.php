<?php
    include('Employee.php');
    include('Department.php');

    use App\Employee;

    require_once('vendor/autoload.php');

    //Create Employee
    $Employee1 = new Employee(85521, "Sergey", 8888, '04-11-2002');
    $Employee2 = new Employee(8121, "Oleg", 10000, '12-11-2012');
    $Employee3 = new Employee(78921, "Tom", 12000, '01-09-2020');
    //Create Employee with invalid data
    try {
        $Employee4 = new Employee(78, "Tom", 12000, '01092020');
    
    } catch(Exception $e) {
        echo $e->getMessage()."\n";
    }
    //Use function get_experients()---->
    echo "Experient of work: ". ($Employee1->get_experients())."\n";
    //Create Departments
    $Department1 = new Department("PIN", array($Employee1, $Employee2, $Employee3));
    $Department2 = new Department("KT", array(new Employee(12321, "Sergey", 10296, '06-11-2022'),new Employee(859999,"Olga",10296,'04-12-2008'),new Employee(812122,"Anton",10296,'04-09-2012')));
    $Department3 = new Department("BMS", array(new Employee(127852, "Max", 109900, '06-11-2021'),new Employee(1221212,"Sergey",10990,'06-11-2022'),new Employee(123999,"Olga",19000,'04-12-2008'),new Employee(812322,"Anton",28000,'04-09-2012')));
    $Department4 = new Department("AR", array(new Employee(8599991, "Tamara", 160000, '04-12-2008'),new Employee(84232,"Marina",30000,'04-09-2012')));
    $AllDepartments = array($Department1,$Department2,$Department3,$Department4);
    //Calculate the salary values for each depatrment for finding main and max
    $All_total_salary = array();
    foreach ($AllDepartments as $department) {
        $All_total_salary+=array($department->get_name()=>$department->total_salary());
    }
    //array to store all matching departments
    $max_salary=array();
    $min_salary = array();

    foreach ($AllDepartments as $department) {
        if ($department->total_salary() == min($All_total_salary)) {
            $min_salary+=array($department->get_name()=>$department);
        }
        if ($department->total_salary() == max($All_total_salary)) {
            $max_salary+=array($department);
        }
    }

    echo "Max(".max($All_total_salary).") and Min(". min($All_total_salary). ") salaries----->\n";
    //compare count employees and print
    foreach ([$max_salary,$min_salary] as $array_with_salary) {
        if (count($array_with_salary)>1) {
            $count_employees=0;
            foreach($array_with_salary as $k=>$v) {
                if($count_employees< $v->get_count_employee()) {
                    $count_employees = $v->get_count_employee();
                }
            }
            foreach ($array_with_salary as $k=>$v) {
                if ($count_employees == $v->get_count_employee()) {
                    $v->beautiful_string();
                }
            }
        } else {
            array_values($array_with_salary)[0]->beautiful_string();
    }
    echo "-------------------------------------------\n";
    }

?>