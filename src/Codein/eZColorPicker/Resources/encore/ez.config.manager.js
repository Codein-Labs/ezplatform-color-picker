const path = require('path');

module.exports = (eZConfig, eZConfigManager) => {
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-content-edit-parts-js',
        newItems: [path.resolve(__dirname, '../public/content-edit.js')],
    });
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-content-edit-parts-css',
        newItems: [path.resolve(__dirname, '../public/content-edit.js')],
    });
    eZConfigManager.add({
        eZConfig,
        entryName: 'ezplatform-admin-ui-location-view-css',
        newItems: [path.resolve(__dirname, '../public/location-view.js')],
    });
};
