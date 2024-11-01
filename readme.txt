=== Captcha Enjoy ===
Contributors: Captcha Enjoy
Tags: türkçe captcha, captcha, captcha enjoy, form güvenliði, botlardan korunma
Requires at least: 3.8
Tested up to: 4.8
Stable tag: 0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Register: http://captchaenjoy.com/#getcode
Link: http://captchaenjoy.com/

"This plugin uses [CaptchaEnjoy](http://captchaenjoy.com/) to serve captcha files"

Bu eklenti captcha dosyalarýný http://captchaenjoy.com/ adresinde tutmaktadýr.


Captcha Enjoy ile sitenizi botlardan koruyun, site içerigiyle ilgili eglenceli sorularla 
kullanýcýlarýnýzý göz bozan captchalardan kurtarýn

== Description ==

Captcha Enjoy web sitenizdeki form guvenligini saglarken, site iceriginizle benzer 
captcha iceriklerini kullanicilariniza gostererek; onlari goz bozan, karmasik 
captcha anlayisindan kurtariyor.

== Installation == 

Eklentiler bolumunde Captcha Enjoy'u aktif ettikten sonra Ayarlar'in altindan Captcha Enjoy
paneline ulasabilirsiniz. Bu panelde size iki secenek sunuyoruz. Dilerseniz yorum alaninda,
dilerseniz login ekraninda, dilerseniz her iki alanda birden Captcha Enjoy'u kullanabilirsiniz.

== Frequently Asked Questions == 

Farkli ne yapiyorsunuz ? 
-Captcha Enjoy size eglenceli bir guvenlik hizmeti sunuyor.

Site konusunu neden secmeliyim?
-Captcha Enjoy site kullanicilariniza sizin sitenizle ilgili sorular sormak istiyor. Bu nedenle
site konunuzu secerseniz Captcha Enjoy'un isini kolaylastirmis olacaksiniz.

------------------------------------------------------------------------------

== Calling About Js File Other Servers - Baþka sunucudan cekilen js dosyasi hakkinda ==

Captcha Enjoy bir guvenlik yazilimidir. Amaci botlarla insanlari birbirinden ayirarak web sitenizin
guvenligini saglamaktir. Captcha Enjoy Wordpress Eklentisinde baska bir sunucudan bir adet 
javascript dosyasi, bir adet de css dosyasi cagrilmaktadir. 
Disaridan cagirilan javascript dosyasinda girilen verilerin Captcha Enjoy sunucularinda 
dogrulanma islemi yapilmaktadir. Yani sorulan soruya gelen cevap cagirilan javascript dosyasi 
araciligi ile Captcha Enjoy Api'sinde bulunan gerekli fonksiyona gonderilir ve bu fonksiyonda
arka tarafta cevabin dogrulugunu kontrol eder. Kontrolden sonrada tekrar var olan siteye 
(Captcha Enjoy Eklentisi) geri donuste bulunur. Eklenti bu donusu degerlendirir ve formu dolduranin
bot ya da insan oldugunun ayrimini yapar. Baska sunucudan cagirilan javascript dosyasinin tek gorevi
budur.