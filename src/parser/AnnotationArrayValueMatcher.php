<?php
	namespace Dadlian\Addendum;

  class AnnotationArrayValueMatcher extends ParallelMatcher {
    protected function build() {
      $this->add(new AnnotationValueInArrayMatcher);
      $this->add(new AnnotationPairMatcher);
    }
  }
?>