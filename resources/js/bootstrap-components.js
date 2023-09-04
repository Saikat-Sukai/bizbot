// resources/js/bootstrap-components.js
import _ from 'lodash';
// This function should return a dictionary of your components
export function loadComponents() {
    const components = {};
    const files = require.context('./module-components', true, /\.vue$/i);
    files.keys().map(key => {
        const componentName = _.upperFirst(
            _.camelCase(
                // Parse out the file name without the extension
                key.split('/').pop().replace(/\.\w+$/, '')
            )
        );
        components[componentName] = files(key).default;
    });
    return components;
}
