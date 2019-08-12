<?php

namespace Drupal\service_overrider;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceModifierInterface;

/**
 * ServiceProvider override.
 *
 * Or... how to do D7 hook_alter() the D8 way...
 */
class ServiceOverriderServiceProvider implements ServiceModifierInterface {

  /**
   * Alter/override any service declared in any module's .services.yml file.
   */
  public function alter(ContainerBuilder $container) {
    $container
      // See core/modules/rest/rest.services.yml.
      ->getDefinition('rest.resource_response.subscriber')
      ->setClass('Drupal\service_overrider\EventSubscriber\AltResourceResponseSubscriber');

    // You can add more ServiceProvider "alters" here using the same idiom.
    // $container->getDefinition('ID')->setClass('Drupal\....')
  }

}
