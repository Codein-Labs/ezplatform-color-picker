const path = require('path');

module.exports = (eZConfig, eZConfigManager) => {
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-layout-css',
        newItems: [path.resolve(__dirname, '../public/scss/admin/codeincolor.scss')],
    });
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-location-view-css',
        newItems: [path.resolve(__dirname, '../public/scss/admin/codeincolor-view.scss')],
    });
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-content-type-edit-js',
        newItems: [path.resolve(__dirname, '../public/js/admin/codeincolor.js')],
    });
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-content-edit-parts-js',
        newItems: [path.resolve(__dirname, '../public/js/admin/codeincolor.js')],
    });
};