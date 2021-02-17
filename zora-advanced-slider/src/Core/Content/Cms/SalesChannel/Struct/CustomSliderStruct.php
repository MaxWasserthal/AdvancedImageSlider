<?php declare(strict_types=1);

namespace Zora\AdvancedSlider\Core\Content\Cms\SalesChannel\Struct;

use Shopware\Core\Framework\Struct\Struct;
use Zora\AdvancedSlider\Core\Content\Cms\SalesChannel\Struct\CustomSliderItemStruct;

class CustomSliderStruct extends Struct
{
    /**
     * @var CustomSliderItemStruct[]|null
     */
    protected $sliderItems = [];

    /**
     * @var array|null
     */
    protected $navigation;

    /**
     * @return CustomSliderItemStruct[]|null
     */
    public function getSliderItems(): ?array
    {
        return $this->sliderItems;
    }

    /**
     * @param CustomSliderItemStruct[]|null $sliderItems
     */
    public function setSliderItems(?array $sliderItems): void
    {
        $this->sliderItems = $sliderItems;
    }

    public function addSliderItem(CustomSliderItemStruct $sliderItem): void
    {
        $this->sliderItems[] = $sliderItem;
    }

    public function getNavigation(): ?array
    {
        return $this->navigation;
    }

    public function setNavigation(?array $navigation): void
    {
        $this->navigation = $navigation;
    }

    public function getApiAlias(): string
    {
        return 'cms_custom-slider';
    }
}
