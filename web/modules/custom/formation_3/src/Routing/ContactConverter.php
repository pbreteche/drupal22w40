<?php

namespace Drupal\formation_3\Routing;

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Drupal\formation_3\Loader\ContactLoader;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Route;

class ContactConverter implements ParamConverterInterface {
  private ContactLoader $contactLoader;

  public function __construct(ContactLoader $contactLoader) {
    $this->contactLoader = $contactLoader;
  }

  public function convert($value, $definition, $name, array $defaults) {
    $contact = $this->contactLoader->load($value);

    if (!$contact) {
      throw new NotFoundHttpException();
    }

    return $contact;
  }

  public function applies($definition, $name, Route $route) {
    return !empty($definition['type']) && $definition['type'] == 'contact-type';
  }
}
