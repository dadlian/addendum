<?php
	namespace Dadlian\Addendum\Annotations;

  class ReflectionAnnotatedClass extends \ReflectionClass {
    private $annotations;

    public function __construct($class) {
      parent::__construct($class);
      $this->annotations = $this->createAnnotationBuilder()->build($this);
    }

    public function hasAnnotation($class) {
      return $this->annotations->hasAnnotation($class);
    }

    public function getAnnotation($annotation) {
      return $this->annotations->getAnnotation($annotation);
    }

    public function getInheritedAnnotation($annotation) {
      for ( $rac = $this ; $rac ; $rac = $rac->getParentClass() )
        if ( $result = $rac->annotations->getAnnotation($annotation) )
          return $result;
      return null;
    }

    public function getAnnotations() {
      return $this->annotations->getAnnotations();
    }

    public function getAllAnnotations($restriction = false) {
      return $this->annotations->getAllAnnotations($restriction);
    }

    public function getAllInheritedAnnotations($restriction = false) {
      $result = array();
      for ( $rac = $this ; $rac ; $rac = $rac->getParentClass() )
        $result = array_merge($result, $rac->getAllAnnotations($restriction));
      return $result;
    }

    public function getConstructor() : ?\ReflectionMethod {
      return $this->createReflectionAnnotatedMethod(parent::getConstructor());
    }

    public function getMethod($name): \ReflectionMethod {
      return $this->createReflectionAnnotatedMethod(parent::getMethod($name));
    }

    public function getMethods($filter = -1): array {
      $result = array();
      foreach(parent::getMethods($filter) as $method) {
        $result[] = $this->createReflectionAnnotatedMethod($method);
      }
      return $result;
    }

    public function getProperty($name): \ReflectionProperty {
      return $this->createReflectionAnnotatedProperty(parent::getProperty($name));
    }

    public function getProperties($filter = -1): array {
      $result = array();
      foreach(parent::getProperties($filter) as $property) {
        $result[] = $this->createReflectionAnnotatedProperty($property);
      }
      return $result;
    }

    public function getInterfaces(): array {
      $result = array();
      foreach(parent::getInterfaces() as $interface) {
        $result[] = $this->createReflectionAnnotatedClass($interface);
      }
      return $result;
    }

    public function getParentClass(): \ReflectionClass | false {
      $class = parent::getParentClass();
      return $this->createReflectionAnnotatedClass($class);
    }

    protected function createAnnotationBuilder() {
      return new AnnotationsBuilder();
    }

    private function createReflectionAnnotatedClass($class) {
      return ($class !== false) ? new ReflectionAnnotatedClass($class->getName()) : false;
    }

    private function createReflectionAnnotatedMethod($method) {
      return ($method !== null) ? new ReflectionAnnotatedMethod($this->getName(), $method->getName()) : null;
    }

    private function createReflectionAnnotatedProperty($property) {
      return ($property !== null) ? new ReflectionAnnotatedProperty($this->getName(), $property->getName()) : null;
    }
  }
?>
