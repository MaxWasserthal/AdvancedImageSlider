import './component';
import './preview';

Shopware.Service('cmsService').registerCmsBlock({
    name: 'advancedslider',
    label: 'Advanced Slider',
    category: 'text-image',
    component: 'sw-cms-block-advancedslider',
    previewComponent: 'sw-cms-preview-advancedslider',
    defaultConfig: {
        marginBottom: '0px',
        marginTop: '0px',
        marginLeft: '0px',
        marginRight: '0px',
        sizingMode: 'full_width'
    },
    slots: {
        'advancedslider': {
            type: 'advancedslider'
        } 
    }
});