C:\OpenServer\domains\kibrit\protected\extensions\packagecompressor\yuicompresso
r>java -jar yuicompressor-2.4.7.jar C:/OpenServer/domains/kibrit/assets/javascri
pts/content.js -o C:/OpenServer/domains/kibrit/assets/javascripts/build/content.
min.js

copy /b /*.js merged.js && java -jar yuicompressor-2.4.7.jar C:/OpenServer/domains/kibrit/assets/javascripts/merged.js -o C:/OpenServer/domains/kibrit/assets/javascripts/build/merged.min.js


java -jar yuicompressor-2.4.7.jar C:/OpenServer/domains/kibrit/assets/javascripts/*.js -o ".js$:-min.js"

for %f in (*.js) do echo ; >> %f copy /b *.js merged.js java -jar yuicompressor-2.4.7.jar merged.js -o merged.min.js pause





for %f in (C:/OpenServer/domains/kibrit/assets/javascripts/*.js) do echo ; >> %f

copy /b "C:/OpenServer/domains/kibrit/assets/javascripts/*.js" "C:/OpenServer/domains/kibrit/assets/javascripts/merged.js"

java -jar yuicompressor-2.4.7.jar "C:/OpenServer/domains/kibrit/assets/javascripts/merged.js" -o "C:/OpenServer/domains/kibrit/assets/javascripts/build/merged.min.js"




for %f in (C:/OpenServer/domains/kibrit/assets/css/*.css) do echo ; >> %f

copy /b "C:/OpenServer/domains/kibrit/assets/css/*.css" "C:/OpenServer/domains/kibrit/assets/css/merged.css"

java -jar yuicompressor-2.4.7.jar "C:/OpenServer/domains/kibrit/assets/css/merged.css" -o "C:/OpenServer/domains/kibrit/assets/css/build/merged.min.css"



copy "C:/OpenServer/domains/kibrit/assets/css/styles.css" "C:/OpenServer/domains/kibrit/assets/css/merged.css"



copy /b "*.js" "merged.js"

for %%a in (merged.js) do @java -jar "C:/OpenServer/domains/kibrit/protected/extensions/packagecompressor/yuicompressor/yuicompressor-2.4.7.jar" "%%a" -o "build\%%a"


copy /b "*.js" "merged.js"

java -jar "C:/OpenServer/domains/kibrit/protected/extensions/packagecompressor/yuicompressor/yuicompressor-2.4.7.jar" "merged.js" -o "build/merged.min.js"



java -jar "C:/OpenServer/domains/kibrit/protected/extensions/packagecompressor/yuicompressor/yuicompressor-2.4.7.jar" "merged.js" -o "C:/OpenServer/domains/kibrit/assets/javascripts/merged.min.js"