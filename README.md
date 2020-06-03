## mediawiki-extensions-ImageOptimizer
Make the pictures uploaded to mediawiki stored after being compressed, use mozjpeg, pngquant, gifsicle to get the best quality to volume ratio.

- This extension has no configuration parameter settings, you need to have certain PHP technology and server technology to adjust the code to meet your needs.
- The binary files of mozjpeg, pngquant, and gifsicle are included in the extension. They are compiled on the x86_64 CentOS 7 server. If your server has the same architecture, you may be able to run it directly. If it does not work, you need to manually compile or distribute through the package To install these features for your server and modify the running location in autoload.php to point to them


将上传到mediawiki的图片压缩后保存，使用mozjpeg，pngquant，gifsicle获得最佳的质量体积比。
- 这个扩展没有配置参数设置，您需要拥有一定的php技术以及服务器技术来调整代码以符合您的使用需求。
- 扩展中附带了mozjpeg, pngquant, gifsicle的二进制文件，他们是在x86_64的CentOS 7 服务器上编译的，如果您的服务器是相同的架构，也许可以直接运行，如果不行，您需要手动编译或通过包发行来为您的服务器安装这些功能，并修改autoload.php中的运行位置来指向他们
