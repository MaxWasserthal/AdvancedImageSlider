import './component';
import './config';
import './preview';

Shopware.Service('cmsService').registerCmsElement({
    name: 'advancedslider',
    label: 'Advanced Slider',
    component: 'sw-cms-el-advancedslider',
    configComponent: 'sw-cms-el-config-advancedslider',
    previewComponent: 'sw-cms-el-preview-advancedslider',
    defaultConfig: {
        sliderItems: {
            source: 'static',
            value: [],
            required: true,
            entity: {
                name: 'media'
            }
        },
        navigationArrows: {
            source: 'static',
            value: 'outside'
        },
        navigationDots: {
            source: 'static',
            value: null
        },
        displayMode: {
            source: 'static',
            value: 'standard'
        },
        minHeight: {
            source: 'static',
            value: '300px'
        },
        verticalAlign: {
            source: 'static',
            value: null
        }
    },
    enrich: function enrich(elem, data) {
        if (Object.keys(data).length < 1) {
            return;
        }

        Object.keys(elem.config).forEach((configKey) => {
            const entity = elem.config[configKey].entity;

            if (!entity) {
                return;
            }

            const entityKey = entity.name;
            if (!data[`entity-${entityKey}`]) {
                return;
            }

            elem.data[configKey] = [];
            elem.config[configKey].value.forEach((sliderItem) => {
                elem.data[configKey].push({
                    newTab: sliderItem.newTab,
                    url: sliderItem.url,
                    media: data[`entity-${entityKey}`].get(sliderItem.mediaId),
                    sText: sliderItem.sText,
                    btnText: sliderItem.btnText
                });
            });
        });
    }
});