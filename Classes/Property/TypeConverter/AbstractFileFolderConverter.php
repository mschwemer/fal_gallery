<?php
namespace CoStack\FalGallery\Property\TypeConverter;

/*
 * (c) Oliver Eglseder <php@vxvr.de>
 *
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\ResourceInterface;
use TYPO3\CMS\Extbase\Property\Exception;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;

/**
 * Class AbstractFileFolderConverter
 */
abstract class AbstractFileFolderConverter extends AbstractTypeConverter
{
    /**
     * @var int
     */
    protected $priority = 10;

    /**
     * @var string
     */
    protected $expectedObjectType;

    /**
     * @var \TYPO3\CMS\Core\Resource\ResourceFactory
     */
    protected $fileFactory;

    /**
     * @param \TYPO3\CMS\Core\Resource\ResourceFactory $fileFactory
     */
    public function injectFileFactory(ResourceFactory $fileFactory): void
    {
        $this->fileFactory = $fileFactory;
    }

    /**
     * @param int|string $source
     * @param string $targetType
     * @param array $convertedChildProperties
     * @param PropertyMappingConfigurationInterface $configuration
     *
     * @return mixed
     * @throws Exception
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function convertFrom(
        $source,
        string $targetType,
        array $convertedChildProperties = [],
        PropertyMappingConfigurationInterface $configuration = null
    ) {
        $object = $this->getOriginalResource($source);
        if (empty($this->expectedObjectType) || !$object instanceof $this->expectedObjectType) {
            throw new Exception(
                'Expected object of type "' . $this->expectedObjectType . '" but got ' . get_class($object),
                1342895975
            );
        }
        return $object;
    }

    /**
     * @param string|int $source
     * @return \TYPO3\CMS\Core\Resource\ResourceInterface|null
     */
    abstract protected function getOriginalResource($source): ?ResourceInterface;
}
