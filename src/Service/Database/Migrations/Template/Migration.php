<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class Migration {

    private $className;
    private $up;
    private $down;

    public function setClassName($className) {
        $this->className = $className;
        return $this;
    }

    public function setUp($up)
    {
        $this->up = $up;
        return $this;
    }

    public function setDown($down)
    {
        $this->down = $down;
        return $this;
    }


    public function get() {
        return "<?php
      
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class {$this->className} extends Migration
{
    public function up()
    {
        $this->up
    }
    
    public function down()
    {
        $this->down
    }
}
";
    }
}
