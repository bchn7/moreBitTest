<?php 

class Document {
    public $status = 'Created';
    public $createdBy;

    public function submit() {
        $this->status = 'Submitted';
    }

}

class Workflow {
    public static function approve(Document $document, $approver) {
        if ($document->status === 'Accepted') {
            $document->status = 'Approved by ' . $approver;
        }
    }

    public static function reject(Document $document, $approver) {
        if ($document->status === 'Accepted') {
            $document->status = 'Rejected by ' . $approver;
        }
    }

    public static function accept(Document $document, $approver) {
        if ($document->status === 'Submitted') {
            $document->status = 'Accepted';
        }
    }

    public static function deny(Document $document, $approver) {
        if ($document->status === 'Submitted') {
            $document->status = 'Denyed by ' . $approver;
        }
    }
}

class Employee {
    public $name;

    public $role;
    public $onVacation = false;
    public $substitute;

    public function approveDocument(Document $document) {
        if ($this->role == "CEO") {
            if ($this->onVacation && $this->substitute) {
                Workflow::approve($document, $this->substitute->name);
            } else {
                Workflow::approve($document, $this->name);
            }
        } else {
            print ("You need to be a CEO to approve this document!");
        }
    }

    public function rejectDocument(Document $document) {
        if ($this->role == "MANAGER") {
            if ($this->onVacation && $this->substitute) {
                Workflow::reject($document, $this->substitute->name);
            } else {
                Workflow::reject($document, $this->name);
            }
        } else {
            print ("You need to be a CEO to reject this document!");
        }
    }

    public function acceptDocument(Document $document) {
        if ($this->role == "MANAGER") {
            if ($this->onVacation && $this->substitute) {
                Workflow::accept($document, $this->substitute->name);
            } else {
                Workflow::accept($document, $this->name);
            }
        } else {
            print ("You need to be a manager to accept this document!");
        }
    }

    public function denyDocument(Document $document) {
        if ($this->role == "MANAGER") {
            if ($this->onVacation && $this->substitute) {
                Workflow::deny($document, $this->substitute->name);
            } else {
                Workflow::deny($document, $this->name);
            }
        } else {
            print ("You need to be a manager to deny this document!");
        }
    }
}

// Przykład użycia
$employee = new Employee();
$employee->name = "John";
$employee->role = "EMPLOYEE";

$ceo = new Employee();
$ceo->name = "Jane";
$ceo->role = "CEO";
$ceo->onVacation = true;

$cto = new Employee();
$cto->name = "Carlos";
$cto->role = "CTO";

$manager = new Employee();
$manager->name = "Greg";
$manager->role = "MANAGER";

$ceo->substitute = $cto;

$document = new Document();
$document->createdBy = $employee->name;

$document->submit();

$manager->acceptDocument($document);
echo "Status dokumentu: " . $document->status . "<br>";

$ceo->approveDocument($document);

echo "Status dokumentu: " . $document->status . "<br>";
