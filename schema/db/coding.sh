
# create model and database,apiController, factory,seeder,policy,request
php artisan make:model {Shop,Productcategory,Kalagroup,Product,Kala,Categorizedproduct} -a --api

# rollback
php artisan migrate:rollback

# tinker shell for laravel
php artisan tinker

# create resoureces
php artisan make:resourece {Shop,Productcategory,Kalagroup,Product,Kala,Categorizedproduct}.Resource

#making app/repositories dir for better control on logic

#handle Exception
php artisan make:excepiton GeneralJsonException
path: app/Exceptions/
report method is run before render method



#Using Events In an Api server
using Event+Event Listener
#this is for test
php artisan make:event ShopCreated
php artisan make:listener SendWelcomeEmail

#beter solution for event +listener mapping is Subscripber

#building and sending Email
php artisan make:mail WelcomeMail



