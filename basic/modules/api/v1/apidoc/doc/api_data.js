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
    "url": "v1/auth/logout",
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
  },
  {
    "type": "get",
    "url": "v1/document/html/?uuid=xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxx",
    "title": "Html entity of document",
    "name": "documentHtml",
    "group": "Documents",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "uuid",
            "description": "<p>UUID of document</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n   \"success\": true,\n   \"data\": \"<!DOCTYPE html>code</html>\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/DocumentController.php",
    "groupTitle": "Documents"
  },
  {
    "type": "post",
    "url": "v1/project",
    "title": "Create",
    "name": "createProject",
    "group": "Projects",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>Title of project</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "text",
            "description": "<p>Text of project</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n\"title\": \"title of project\",\n\"text\": \"text of project, will be an html\",\n\"user\": 1,\n\"id\": 40\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/ProjectController.php",
    "groupTitle": "Projects"
  },
  {
    "type": "delete",
    "url": "v1/project/:id",
    "title": "Delete",
    "name": "projectDelete",
    "group": "Projects",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "id",
            "description": "<p>Project ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/ProjectController.php",
    "groupTitle": "Projects"
  },
  {
    "type": "put",
    "url": "v1/project/:id",
    "title": "Edit",
    "name": "projectEdit",
    "group": "Projects",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "id",
            "description": "<p>Project ID</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>Title of project</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "text",
            "description": "<p>Text of project</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n\"id\": 8,\n\"title\": \"new title\",\n\"position\": 0,\n\"user\": 1,\n\"text\": \"new text\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/ProjectController.php",
    "groupTitle": "Projects"
  },
  {
    "type": "get",
    "url": "v1/project/:id?expand=entity",
    "title": "Entities of project",
    "name": "projectEntities",
    "group": "Projects",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>Project ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n\"id\": 1,\n\"title\": \"ProjectX\",\n\"position\": 0,\n\"user\": 1,\n\"text\": null,\n\"entity\": [\n{\n\"id\": 2163,\n\"doc_id\": 14,\n\"tag_id\": null,\n\"tag_type\": 0,\n\"selection\": null,\n\"sent_hl\": \"Otherwise, use this document as an instruction set.\",\n\"manual_date\": null,\n\"entity\": \"instruction set\",\n\"entity_type\": \"FieldTerminology\",\n\"note\": null\n},\n{\n\"id\": 2164,\n\"doc_id\": 14,\n\"tag_id\": null,\n\"tag_type\": 0,\n\"selection\": null,\n\"sent_hl\": \"Instructions about final paper and figure submissions in this document are for IEEE journals;  please use this document as a “template” to prepare your manuscript.\",\n\"manual_date\": null,\n\"entity\": \"IEEE\",\n\"entity_type\": \"Organization\",\n\"note\": null\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/ProjectController.php",
    "groupTitle": "Projects"
  },
  {
    "type": "get",
    "url": "v1/project",
    "title": "List",
    "name": "projectList",
    "group": "Projects",
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": [\n{\n\"id\": 1,\n\"title\": \"ProjectX\",\n\"position\": 0,\n\"user\": 1,\n\"text\": null\n},\n{\n\"id\": 2,\n\"title\": \"Project 2\",\n\"position\": 0,\n\"user\": 1,\n\"text\": \"html of project report\"\n}]}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/ProjectController.php",
    "groupTitle": "Projects"
  },
  {
    "type": "get",
    "url": "v1/project/:id",
    "title": "View",
    "name": "projectView",
    "group": "Projects",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>Project ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n\"id\": 39,\n\"title\": \"title of project\",\n\"position\": 0,\n\"user\": 1,\n\"text\": \"text of project, will be an html\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/ProjectController.php",
    "groupTitle": "Projects"
  },
  {
    "type": "get",
    "url": "v1/project/:id?expand=documents",
    "title": "Documents of project",
    "name": "projectdocuments",
    "group": "Projects",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>Project ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n\"id\": 1,\n\"title\": \"ProjectX\",\n\"position\": 0,\n\"user\": 1,\n\"text\": null,\n\"documents\": [\n{\n\"id\": 1,\n\"project_id\": 1,\n\"user\": 1,\n\"title\": \"demo.docx\",\n\"uploaded_date\": 1462433362,\n\"user_ip\": \"193.84.22.110\",\n\"user_agent\": \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\",\n\"html_file\": \"1.html\",\n\"uuid\":  \"8029b331-12c2-11e6-a0ac-061c72b17085\"\n},\n{\n\"id\": 14,\n\"project_id\": 1,\n\"user\": 1,\n\"title\": \"p.pdf\",\n\"uploaded_date\": 1462453726,\n\"user_ip\": \"193.84.22.110\",\n\"user_agent\": \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\",\n\"html_file\": \"14.html\",\n\"uuid\": \"8029b331-12c2-11e6-a0ac-061c72b17085\"\n}\n]\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/ProjectController.php",
    "groupTitle": "Projects"
  }
] });
