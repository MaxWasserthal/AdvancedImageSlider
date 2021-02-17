<?php declare(strict_types=1);

namespace Zora\AdvancedSlider\Core\Content\Media\Cms;

use Zora\AdvancedSlider\Core\Content\Cms\SalesChannel\Struct\CustomSliderItemStruct;
use Zora\AdvancedSlider\Core\Content\Cms\SalesChannel\Struct\CustomSliderStruct;
use Shopware\Core\Content\Cms\Aggregate\CmsSlot\CmsSlotEntity;
use Shopware\Core\Content\Cms\DataResolver\CriteriaCollection;
use Shopware\Core\Content\Cms\DataResolver\Element\AbstractCmsElementResolver;
use Shopware\Core\Content\Cms\DataResolver\Element\ElementDataCollection;
use Shopware\Core\Content\Cms\DataResolver\ResolverContext\ResolverContext;
use Shopware\Core\Content\Cms\Exception\DuplicateCriteriaKeyException;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Exception\InconsistentCriteriaIdsException;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;

class ImageCmsElementResolver extends AbstractCmsElementResolver
{
    public function getType(): string
    {
        return 'advancedslider';
    }

    /**
     * @throws DuplicateCriteriaKeyException
     * @throws InconsistentCriteriaIdsException
     */
    public function collect(CmsSlotEntity $slot, ResolverContext $resolverContext): ?CriteriaCollection
    {
        $config = $slot->getFieldConfig();
        $sliderItemsConfig = $config->get('sliderItems');

        if (!$sliderItemsConfig || $sliderItemsConfig->isMapped()) {
            return null;
        }

        $sliderItems = $sliderItemsConfig->getValue();

        $mediaIds = array_column($sliderItems, 'mediaId');

        $criteria = new Criteria($mediaIds);

        $criteriaCollection = new CriteriaCollection();
        $criteriaCollection->add('media_' . $slot->getUniqueIdentifier(), MediaDefinition::class, $criteria);

        return $criteriaCollection;
    }

    public function enrich(CmsSlotEntity $slot, ResolverContext $resolverContext, ElementDataCollection $result): void
    {
        $config = $slot->getFieldConfig();
        $imageSlider = new CustomSliderStruct();
        $slot->setData($imageSlider);

        if (($navigation = $config->get('navigation')) && $navigation->isStatic()) {
            $imageSlider->setNavigation($navigation->getValue());
        }

        if ($sliderItems = $config->get('sliderItems')) {
            foreach ($sliderItems->getValue() as $sliderItem) {
                $this->addMedia($slot, $imageSlider, $result, $sliderItem);
            }
        }
    }

    private function addMedia(CmsSlotEntity $slot, CustomSliderStruct $imageSlider, ElementDataCollection $result, array $config): void
    {
        $imageSliderItem = new CustomSliderItemStruct();

        if (!empty($config['url'])) {
            $imageSliderItem->setUrl($config['url']);
            $imageSliderItem->setNewTab($config['newTab']);
        }

        $searchResult = $result->get('media_' . $slot->getUniqueIdentifier());
        if (!$searchResult) {
            return;
        }

        $imageSliderItem->setSText($config['sText']);

        $imageSliderItem->setBtnText($config['btnText']);

        /** @var MediaEntity|null $media */
        $media = $searchResult->get($config['mediaId']);
        if (!$media) {
            return;
        }

        $imageSliderItem->setMedia($media);
        $imageSlider->addSliderItem($imageSliderItem);
    }
}
