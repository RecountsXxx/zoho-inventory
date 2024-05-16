Integration Zoho Inventory per Sales Orders, Purchase Orders, Contacts, Taxes

**Deployment**
<br>
<br>
**Front**
```
cd front
npm i
npm run serve
```
**Back**
<br>
Create env file and fill
```
cd back
composer install
php artisan key:generate
php artisan serve
```
Scopes: ZohoInventory.contacts.ALL,ZohoCRM.modules.ALL,ZohoInventory.items.ALL,ZohoInventory.purchaseorders.ALL,ZohoInventory.salesorders.ALL,ZohoInventory.settings.ALL

**Screenshots**

![Снимок экрана от 2024-05-16 20-03-35](https://github.com/RecountsXxx/zoho-inventory/assets/107986811/1516d66f-bdf6-41a6-96ec-a1c3efb27573)
![Снимок экрана от 2024-05-16 20-03-33](https://github.com/RecountsXxx/zoho-inventory/assets/107986811/3b7ca53a-c793-482e-8470-81dc52600bdb)


https://github.com/RecountsXxx/zoho-inventory/assets/107986811/1a6054e0-5fe7-4301-9c08-928d329a3d1a

