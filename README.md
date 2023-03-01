# CAF SDK for PHP

## Instalação
Execute no diretório do seu projeto:
    composer require ipagdevs/caf-sdk-php

## Transação
### Criar 
```php
$cafApi = new CafClient('YOU_TOKEN_CAF');

$request = new TransactionRequest('templateId');
$request->useCnpj('cnpjOnlyNumbers');

$cafApi->createTransaction($request);
/*
response 
{​
  "requestId": "6cb8093c-14ef-4fd1-810b-ee9fa5f9aae9",​
  "id": "6021a21b3811c35ecb8dea20"​
​}
*/
```
### Consultar todas as transações
```php
$cafApi = new CafClient('YOU_TOKEN_CAF');

$cafApi->getTransactions();
/*
response 
{​
  "requestId": "6cb8093c-14ef-4fd1-810b-ee9fa5f9aae9",​
  "items": [​
    {​
      "id": "6388ac6b409eff000804dadf",​
      "status": "APPROVED",​
      "createdAt": "2022-09-08T22:10:14.816Z",​
      "data": {​
        "cpf": "00011122233",​
        "birthDate": "01/01/2000",​
        "name": "John Doe"​
      }​
    },​
    {​
      "id": "6388a3e9a73b280008ba31ad",​
      "status": "REPROVED",​
      "createdAt": "2022-09-08T20:19:23.816Z",​
      "data": {​
        "cnpj": "00111222333344"​
      }​
    }​
  ],​
  "totalItems": 2​
​}
*/
```
### Consultar transação específica
```php
$cafApi = new CafClient('YOU_TOKEN_CAF');

$cafApi->getTransaction('id');
/*
response
{​
  "requestId": "2b8f373-c462-4bbf-9a4f-8aeb7d71ec53",​
  "id": "6388a3e9a73b280008ba31ad",​
  "status": "APPROVED",​
  "customStatus": null,​
  "templateId": "638a021fdeb2b90008c790d1",​
  "onboardingId": null,​
  "attributes": {},​
  "createdAt": "2022-09-08T22:10:14.816Z",​
  "type": "cnh",​
  "images": {​
    "back": "https://example.com/image-back.jpg",​
    "front": "https://example.com/image-front.jpg",​
    "selfie": "https://example.com/selfie.jpg",​
    "selectedBack": "https://example.com/image-back-cropped.jpg",​
    "selectedFront": "https://example.com/image-front-cropped.jpg"​
  },​
  "sections": {},​
  "fraud": false,​
  "files": [​
    {​
      "name": "Address proof",​
      "src": "https://example.com/address-proof.pdf"​
    }​
  ],​
  "documentscopyRequestDate": "2022-09-08T22:11:05.816Z",​
  "relatedTransactions": {},​
  "history": [​
    {​
      "type": "STATUS_UPDATE",​
      "status": "REPROVED",​
      "date": "2022-09-08T22:12:17.816Z"​
    }​
  ],​
  "statusReasons": [​
    {​
      "category": "VALIDATION",​
      "resultStatus": "APPROVED",​
      "resultCustomStatus": "string",​
      "code": "facematch_is_equal",​
      "status": "VALID",​
      "description": null,​
      "user": null,​
      "date": null,​
      "reviewType": null​
    }​
  ],​
  "manualReprovalReasons": [​
    {​
      "code": "50",​
      "reason": "Documento ilegível: qualidade da foto está ruim."​
    }​
  ],​
  "variables": {},​
  "metadata": {}​
​}
*/
```
## Onboarding
### Criar
```php
$cafApi = new CafClient('YOU_TOKEN_CAF');
$request = new OnboardingRequest(Type::pf(), 'templateId');
$request->useEmail('emailClient')
$request->useSmsPhoneNumber('numberPhoneClient');

$cafApi->createOnboarding($request);
/*
response
{​
  "requestId": "6cb8093c-14ef-4fd1-810b-ee9fa5f9aae9",​
  "id": "6021a21b3811c35ecb8dea20",​
  "url": "https://link-onbording?token=<token>"​
​}
*/

