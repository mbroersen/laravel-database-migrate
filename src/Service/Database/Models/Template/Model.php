<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class Model {

    private $className;
    private $fields;
    private $relations;

    public function setClassName($className) {
        $this->className = $className;
        return $this;
    }

    public function setFields(array $fields)
    {
        $this->fields = implode("'," . PHP_EOL, $fields);

        return $this;
    }


    public function get() {
        return "<?php
      
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class {$this->className} extends Model
{
    protected \$table = 'page';

    protected \$fillable = {$this->fields}
    
    $this->relations
    
}
";
    }
}
