<?php
	namespace Dadlian\Addendum\Parser;

  class AnnotationValueInArrayMatcher extends AnnotationValueMatcher {
    public function process($value) {
      return array($value);
    }
}
?>
