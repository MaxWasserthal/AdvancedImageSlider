<?php declare(strict_types=1);

namespace Zora\AdvancedSlider\Core\Content\Cms\SalesChannel\Struct;

use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\Struct\Struct;

class CustomSliderItemStruct extends Struct
{
    /**
     * @var MediaEntity|null
     */
    protected $media;

    /**
     * @var string|null
     */
    protected $url;

    /**
     * @var bool|null
     */
    protected $newTab;

    /**
     * @var string|null
     */
    protected $sText;

    /**
     * @var string|null
     */
    protected $btnText;

    public function getMedia(): ?MediaEntity
    {
        return $this->media;
    }

    public function setMedia(?MediaEntity $media): void
    {
        $this->media = $media;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getNewTab(): ?bool
    {
        return $this->newTab;
    }

    public function setNewTab(?bool $newTab): void
    {
        $this->newTab = $newTab;
    }

    public function getSText(): ?string
    {
        return $this->sText;
    }

    public function setSText(?string $sText): void
    {
        $this->sText = $sText;
    }

    public function getBtnText(): ?string
    {
        return $this->btnText;
    }

    public function setBtnText(?string $btnText): void
    {
        $this->btnText = $btnText;
    }

    public function getApiAlias(): string
    {
        return 'cms_custom_slider_item';
    }
}
