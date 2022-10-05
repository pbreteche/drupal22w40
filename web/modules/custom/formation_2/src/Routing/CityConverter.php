<?php

namespace Drupal\formation_2\Routing;

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Route;

class CityConverter implements ParamConverterInterface {

  public function convert($value, $definition, $name, array $defaults) {
    if ($value == 'inconnue') {
      throw new NotFoundHttpException('City does not exists');
    }

    return ucfirst($value);
  }

  public function applies($definition, $name, Route $route) {
    return !empty($definition['type']) && $definition['type'] == 'city-type';
  }

}
