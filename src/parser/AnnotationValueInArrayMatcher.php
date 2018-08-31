<?php
	namespace Dadlian\Addendum;

  class AnnotationValueInArrayMatcher extends AnnotationValueMatcher {
    public function process($value) {
      return array($value);
    }
}
?>
