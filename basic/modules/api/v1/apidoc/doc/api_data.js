define({ "api": [
  {
    "type": "post",
    "url": "v1/auth/login",
    "title": "Login user",
    "name": "userLogin",
    "group": "Authorization",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>Email of User</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>Password of User</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n  \"success\": true,\n  \"access_token\": \"iGtdHnDQkdyZPJHR780-as_wWMSYzoBm\",\n  \"user\": {\n     \"id\": 1,\n     \"userName\": \"admin\",\n     \"email\": \"ad@min.com\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/AuthController.php",
    "groupTitle": "Authorization"
  },
  {
    "type": "post",
    "url": "v1/logout",
    "title": "Logout user",
    "name": "userLogout",
    "group": "Authorization",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n  \"success\": true,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../controllers/AuthController.php",
    "groupTitle": "Authorization"
  }
] });
