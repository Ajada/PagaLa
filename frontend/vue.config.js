const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
  transpileDependencies: true,
  lintOnSave: true,
  outputDir: 'dist',
  pwa: {
    name: 'Protege',
    short_name: 'Protege',
    themeColor: '#fff',
    manifestOptions: {
      background_color: '#fff',
      icons: [
        {
          src: './img/icons/android-chrome-520x520.png',
          sizes: '520x520',
          type: 'image/png'
        },
        {
          src: './img/icons/android-chrome-192x192.png',
          sizes: '192x192',
          type: 'image/png'
        },
        {
          src: './img/icons/apple-touch-icon.png',
          sizes: '168x168',
          type: 'image/png'
        },
        {
          src: './img/icons/favicon-32x32.png',
          sizes: '32x32',
          type: 'image/png'
        },
        {
          src: './img/icons/favicon-16x16.png',
          sizes: '16x16',
          type: 'image/png'
        }
      ]
    },
    iconPaths: {
      favicon32: 'img/icons/favicon-32x32.png',
      favicon16: 'img/icons/favicon-16x16.png',
      appleTouchIcon: 'img/icons/apple-touch-icon.png'
    },
    workboxOptions: {
      exclude: ['.htaccess'],
      runtimeCaching: [
        {
          urlPattern: ({ url }) => url.pathname === '/',
          method: 'GET',
          handler: 'StaleWhileRevalidate',
          options: {
            cacheName: 'newVersionCached'
          }
        },
        {
          urlPattern: ({ url }) => url.pathname === '/',
          method: 'POST',
          handler: 'NetworkOnly',
          options: {
            backgroundSync: {
              name: 'solCached'
            }
          }
        }
      ]
    }
  }
})
