<?php
  namespace App;

  require_once('vendor/autoload.php');

  use DateTime;
  use Symfony\Component\Validator\Constraints as Assert;
  use Symfony\Component\Validator\Validation;
  use Symfony\Component\Validator\Constraints\NotBlank;
  use Symfony\Component\Validator\Constraints\Length;
  use Symfony\Component\Validator\Constraints\Positive;

  class Employee 
  {

      private DateTime $created_at ;
      private DateTime $date_start_work;
      private int $id;
      private int $salary = 0;
      private string $name;
      public function __construct(int $id, string $name, int $salary = 0,string $date )
      {
        $this->validator($id,$name,$salary,$date);
        $this->created_at = new DateTime();
      }

      public function get_id(): int
      {
        return $this->id;
      } 

      public function get_name(): string
      {
        return $this->name;
      } 

      public function get_salary(): int
      {
        return $this->salary;
      } 

      public function get_date(): DateTime
      {
        return $this->date_start_work;
      } 

      public function get_experients(): int
      {
        $today = new DateTime();  
        return $today->diff($this->get_date())->y;
        
      } 

      public  function validator($id,$name,$salary,$date): void
      {
        $validator = Validation::createValidator();
        $input = ['id'=> $id, 'name' => $name, 'salary' => $salary, 'date' => $date ];
        $constrains = new Assert\Collection([
          'id' => [new Assert\Length(['min'=>4]), new Assert\NotBlank()],
          'name' => [new Assert\Length(['min'=>2]), new Assert\NotBlank() ],
          'salary' => [new Assert\NotBlank(), new Assert\Type('integer'), new Assert\Positive() ],
          'date' => [new Assert\NotBlank(), new Assert\DateTime($format = 'd-m-Y')]
        ]);
        $violations = $validator->validate($input, $constrains);
        if (count($violations) > 0) {
          throw new \InvalidArgumentException((string)$violations);
        } else {
          $this->id = $id;
          $this->name = $name;
          $this->salary = $salary;
          $this->date_start_work = DateTime::createFromFormat("d-m-Y", $date);
        }
      }
      public function beautiful_string():string{
        return 'ID: ' . $this->get_id() . ' Name: ' . $this->get_name() . ' Salary: '. $this->get_salary() . ' Work since: '.$this->get_date()->format('d-m-Y') . "\n";
      }
  }

?>