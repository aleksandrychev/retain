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
    "type": "get",
    "url": "v1/document/:id?:field_name=:field_value&sort=:sort_field_name&expand=:expand_item",
    "title": "View",
    "name": "documentView",
    "group": "Documents",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "allowedValues": [
              "notes",
              "entities",
              "dates"
            ],
            "optional": false,
            "field": "expand_item",
            "description": "<p>Name of items to expand (coma separated)</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n\"id\": 106,\n\"project_id\": 32,\n\"user\": 1,\n\"title\": \"WITNESS STATEMENT OF STEVEN K. KRAUSE.pdf\",\n\"uploaded_date\": 1465290826,\n\"user_ip\": \"109.238.77.106\",\n\"user_agent\": \"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36\",\n\"html_file\": \"106.html\",\n\"uuid\": \"23535e3c-2c90-11e6-967c-061c72b17085\",\n\"notes\": [\n{\n\"id\": 1,\n\"text\": \" Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp\",\n\"html\": \"<div class=\\\"t m0 x0 h3 y13 ff2 fs0 fc0 sc0 ls0 ws0\\\"><span class=\\\"_ _b\\\"> </span>Pacific<span class=\\\"_ _a\\\"> </span>Rim<span class=\\\"_ _b\\\"> </span>Mining<span class=\\\"_ _a\\\"> </span>Corp.<span class=\\\"_ _c\\\"> </span>In<span class=\\\"_ _a\\\"> </span>that<span class=\\\"_ _a\\\"> </span>capacity,<span class=\\\"_ _a\\\"> </span>m<span class=\\\"_ _9\\\"></span>y<span class=\\\"_ _d\\\"> </span>duties</div><div class=\\\"t m0 x0 h3 y14 ff2 fs0 fc0 sc0 ls0 ws0\\\">include<span class=\\\"_ _e\\\"> </span>overseeing<span class=\\\"_ _e\\\"> </span>the<span class=\\\"_ _e\\\"> </span>consolidated<span class=\\\"_ _e\\\"> </span>financial<span class=\\\"_ _e\\\"> </span>statements<span class=\\\"_ _e\\\"> </span>of<span class=\\\"_ _e\\\"> </span>P<span class=\\\"_ _9\\\"></span>acific<span class=\\\"_ _e\\\"> </span>Rim<span class=\\\"_ _e\\\"> </span>Mining<span class=\\\"_ _e\\\"> </span>Corp.<span class=\\\"_ _e\\\"> </span>and<span class=\\\"_ _e\\\"> </span>its</div><div class=\\\"t m0 x0 h3 y15 ff2 fs0 fc0 sc0 ls0 ws0\\\">subsidiaries<span class=\\\"_ _7\\\"> </span>(the<span class=\\\"_ _7\\\"> </span>“Pacific<span class=\\\"_ _d\\\"> </span>Rim<span class=\\\"_ _7\\\"> </span>Companies”<span class=\\\"_ _7\\\"> </span>or<span class=\\\"_ _7\\\"> </span>t<span class=\\\"_ _9\\\"></span>he<span class=\\\"_ _7\\\"> </span>“Companies”).<span class=\\\"_ _8\\\"> </span>I<span class=\\\"_ _7\\\"> </span>have<span class=\\\"_ _d\\\"> </span>full<span class=\\\"_ _7\\\"> </span>access<span class=\\\"_ _7\\\"> </span>to<span class=\\\"_ _7\\\"> </span>t<span class=\\\"_ _9\\\"></span>he<span class=\\\"_ _7\\\"> </span>books</div><div class=\\\"t m0 x0 h3 y16 ff2 fs0 fc0 sc0 ls0 ws0\\\">and<span class=\\\"_ _7\\\"> </span>records<span class=\\\"_ _d\\\"> </span>of<span class=\\\"_ _7\\\"> </span>Pa<span class=\\\"_ _9\\\"></span>cific<span class=\\\"_ _7\\\"> </span>Rim<span class=\\\"_ _d\\\"> </span>Mining<span class=\\\"_ _7\\\"> </span>Corp.<span class=\\\"_ _d\\\"> </span>and<span class=\\\"_ _d\\\"> </span>I<span class=\\\"_ _7\\\"> </span>am<span class=\\\"_ _d\\\"> </span>resp</div>\",\n\"note\": null,\n\"date\": null,\n\"doc_id\": 106,\n\"tag_id\": 25,\n\"user_id\": 1,\n\"page_number\": 1,\n\"line_number\": 0,\n\"paragraph_number\": null,\n\"positions\": \"{\\\"top\\\":\\\"439.4375\\\",\\\"right\\\":\\\"599.31640625\\\",\\\"bottom\\\":\\\"532.5\\\",\\\"left\\\":\\\"131.5\\\",\\\"width\\\":\\\"467.81640625\\\",\\\"height\\\":\\\"93.0625\\\",\\\"selector\\\":\\\"1\\\"}\",\n\"color\": null\n}],\n\"entities\": [\n {\n\"id\": 5553,\n\"type\": \"Company\",\n\"entity\": \"Pacific Rim Mining Corp.\",\n\"full_sentence\": \"I currently serve, on a part-time, contract basis, as the Chief Financial Officer (“CFO”) for Pacific Rim Mining Corp.\",\n\"document_id\": 106\n},\n{\n\"id\": 5554,\n\"type\": \"Company\",\n\"entity\": \"Pacific Rim Mining Corp\",\n\"full_sentence\": \"I currently serve, on a part-time, contract basis, as the Chief Financial Officer (“CFO”) for Pacific Rim Mining Corp.\",\n\"document_id\": 106\n}],\n\"dates\": [\n{\n\"id\": 1699,\n\"date\": \"1998\",\n\"full_sentence\": \"I will state at the outset that I worked for the Companies from 1998 to 2002, and then from October 2008 to the present, so I was not present at the Companies for several of the changes in corporate structure that I will discuss in my Witness Statement.\",\n\"document_id\": 106\n},\n{\n\"id\": 1700,\n\"date\": \"2002\",\n\"full_sentence\": \"I will state at the outset that I worked for the Companies from 1998 to 2002, and then from October 2008 to the present, so I was not present at the Companies for several of the changes in corporate structure that I will discuss in my Witness Statement.\",\n\"document_id\": 106\n}]",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/DocumentController.php",
    "groupTitle": "Documents"
  },
  {
    "type": "post",
    "url": "v1/note",
    "title": "Create",
    "name": "createNote",
    "group": "Note",
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n \"id\": 24,\n \"text\": \"Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp\",\n \"html\": null,\n \"note\": null,\n \"date\": null,\n \"doc_id\": 106,\n \"tag_id\": 28,\n \"user_id\": 1,\n \"page_number\": null,\n \"line_number\": null,\n \"paragraph_number\": null,\n \"positions\": null\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/NoteController.php",
    "groupTitle": "Note",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "text",
            "description": "<p>Note text</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "html",
            "description": "<p>Note html</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "note",
            "description": "<p>Note note</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "date",
            "description": "<p>Note date</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "color",
            "description": "<p>Note color</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "doc_id",
            "description": "<p>Document Id</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "tag_id",
            "description": "<p>Tag Id</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "page_number",
            "description": "<p>Page Number</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "line_number",
            "description": "<p>Line Number</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "paragraph_number",
            "description": "<p>Paragraph Number</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "positions",
            "description": "<p>Selection object json</p>"
          }
        ]
      }
    }
  },
  {
    "type": "delete",
    "url": "v1/note/:id",
    "title": "Delete",
    "name": "noteDelete",
    "group": "Note",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "id",
            "description": "<p>Note ID</p>"
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
    "filename": "../controllers/NoteController.php",
    "groupTitle": "Note"
  },
  {
    "type": "put",
    "url": "v1/note/:id",
    "title": "Edit",
    "name": "noteEdit",
    "group": "Note",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "id",
            "description": "<p>Note ID</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "text",
            "description": "<p>Note text</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "html",
            "description": "<p>Note html</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "note",
            "description": "<p>Note note</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "date",
            "description": "<p>Note date</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "color",
            "description": "<p>Note color</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "doc_id",
            "description": "<p>Document Id</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "tag_id",
            "description": "<p>Tag Id</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "page_number",
            "description": "<p>Page Number</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "line_number",
            "description": "<p>Line Number</p>"
          },
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "paragraph_number",
            "description": "<p>Paragraph Number</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "positions",
            "description": "<p>Selection object json</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n \"id\": 24,\n \"text\": \"Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp\",\n \"html\": null,\n \"note\": null,\n \"date\": null,\n \"doc_id\": 106,\n \"tag_id\": 28,\n \"user_id\": 1,\n \"page_number\": null,\n \"line_number\": null,\n \"paragraph_number\": null,\n \"positions\": null\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/NoteController.php",
    "groupTitle": "Note"
  },
  {
    "type": "get",
    "url": "v1/note?:field_name=:field_value&sort=:sort_field_name",
    "title": "List",
    "name": "noteList",
    "group": "Note",
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": [\n     {\n     \"id\": 1,\n     \"text\": \"Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp\",\n     \"html\": \"<div class=\\\"t m0 x0 h3 y13 ff2 fs0 fc0 sc0 ls0 ws0\\\"><span class=\\\"_ _b\\\"> </span>Pacific<span class=\\\"_ _a\\\"> </span>Rim<span class=\\\"_ _b\\\"> </span>Mining<span class=\\\"_ _a\\\"> </span>Corp.<span class=\\\"_ _c\\\"> </span>In<span class=\\\"_ _a\\\"> </span>that<span class=\\\"_ _a\\\"> </span>capacity,<span class=\\\"_ _a\\\"> </span>m<span class=\\\"_ _9\\\"></span>y<span class=\\\"_ _d\\\"> </span>duties</div><div class=\\\"t m0 x0 h3 y14 ff2 fs0 fc0 sc0 ls0 ws0\\\">include<span class=\\\"_ _e\\\"> </span>overseeing<span class=\\\"_ _e\\\"> </span>the<span class=\\\"_ _e\\\"> </span>consolidated<span class=\\\"_ _e\\\"> </span>financial<span class=\\\"_ _e\\\"> </span>statements<span class=\\\"_ _e\\\"> </span>of<span class=\\\"_ _e\\\"> </span>P<span class=\\\"_ _9\\\"></span>acific<span class=\\\"_ _e\\\"> </span>Rim<span class=\\\"_ _e\\\"> </span>Mining<span class=\\\"_ _e\\\"> </span>Corp.<span class=\\\"_ _e\\\"> </span>and<span class=\\\"_ _e\\\"> </span>its</div><div class=\\\"t m0 x0 h3 y15 ff2 fs0 fc0 sc0 ls0 ws0\\\">subsidiaries<span class=\\\"_ _7\\\"> </span>(the<span class=\\\"_ _7\\\"> </span>“Pacific<span class=\\\"_ _d\\\"> </span>Rim<span class=\\\"_ _7\\\"> </span>Companies”<span class=\\\"_ _7\\\"> </span>or<span class=\\\"_ _7\\\"> </span>t<span class=\\\"_ _9\\\"></span>he<span class=\\\"_ _7\\\"> </span>“Companies”).<span class=\\\"_ _8\\\"> </span>I<span class=\\\"_ _7\\\"> </span>have<span class=\\\"_ _d\\\"> </span>full<span class=\\\"_ _7\\\"> </span>access<span class=\\\"_ _7\\\"> </span>to<span class=\\\"_ _7\\\"> </span>t<span class=\\\"_ _9\\\"></span>he<span class=\\\"_ _7\\\"> </span>books</div><div class=\\\"t m0 x0 h3 y16 ff2 fs0 fc0 sc0 ls0 ws0\\\">and<span class=\\\"_ _7\\\"> </span>records<span class=\\\"_ _d\\\"> </span>of<span class=\\\"_ _7\\\"> </span>Pa<span class=\\\"_ _9\\\"></span>cific<span class=\\\"_ _7\\\"> </span>Rim<span class=\\\"_ _d\\\"> </span>Mining<span class=\\\"_ _7\\\"> </span>Corp.<span class=\\\"_ _d\\\"> </span>and<span class=\\\"_ _d\\\"> </span>I<span class=\\\"_ _7\\\"> </span>am<span class=\\\"_ _d\\\"> </span>resp</div>\",\n     \"note\": null,\n     \"date\": null,\n     \"doc_id\": 106,\n     \"tag_id\": 25,\n     \"user_id\": 1,\n     \"page_number\": 1,\n     \"line_number\": 0,\n     \"paragraph_number\": null,\n     \"positions\": \"{\\\"top\\\":\\\"439.4375\\\",\\\"right\\\":\\\"599.31640625\\\",\\\"bottom\\\":\\\"532.5\\\",\\\"left\\\":\\\"131.5\\\",\\\"width\\\":\\\"467.81640625\\\",\\\"height\\\":\\\"93.0625\\\",\\\"selector\\\":\\\"1\\\"}\"\n     }\n  ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/NoteController.php",
    "groupTitle": "Note"
  },
  {
    "type": "get",
    "url": "v1/note/:id",
    "title": "View",
    "name": "noteView",
    "group": "Note",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>Tag ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n \"id\": 24,\n \"text\": \"Pacific Rim Mining Corp. In that capacity, my dutiesinclude overseeing the consolidated financial statements of Pacific Rim Mining Corp. and itssubsidiaries (the “Pacific Rim Companies” or the “Companies”). I have full access to the booksand records of Pacific Rim Mining Corp. and I am resp\",\n \"html\": null,\n \"note\": null,\n \"date\": null,\n \"doc_id\": 106,\n \"tag_id\": 28,\n \"user_id\": 1,\n \"page_number\": null,\n \"line_number\": null,\n \"paragraph_number\": null,\n \"positions\": null\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/NoteController.php",
    "groupTitle": "Note"
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
          "content": "{\n\"success\": true,\n\"data\": {\n\"id\": 1,\n\"title\": \"ProjectX\",\n\"position\": 0,\n\"user\": 1,\n\"text\": null,\n\"entity\": [\n{\n {\n     \"name\": \"tag\",\n     \"type\": \"tag\"\n },\n {\n     \"name\": \"12-09-1098\",\n     \"type\": \"date\"\n },\n {\n     \"name\": \"USA\",\n     \"type\": \"entity\"\n },\n {\n     \"name\": \"Pacific Rim Mining Corp.\",\n     \"type\": \"entity\"\n }\n]\n}\n}",
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
  },
  {
    "type": "post",
    "url": "v1/tags",
    "title": "Create",
    "name": "createTags",
    "group": "Tags",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>Title of tag</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n     \"id\": 28,\n     \"user\": 1,\n     \"title\": \"title of tag\",\n     \"parent_id\": null\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/TagsController.php",
    "groupTitle": "Tags"
  },
  {
    "type": "delete",
    "url": "v1/tags/:id",
    "title": "Delete",
    "name": "tagsDelete",
    "group": "Tags",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "id",
            "description": "<p>Tag ID</p>"
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
    "filename": "../controllers/TagsController.php",
    "groupTitle": "Tags"
  },
  {
    "type": "put",
    "url": "v1/tags/:id",
    "title": "Edit",
    "name": "tagsEdit",
    "group": "Tags",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "integer",
            "optional": false,
            "field": "id",
            "description": "<p>Tag ID</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>Title of tag</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n     \"id\": 28,\n     \"user\": 1,\n     \"title\": \"edited title of tag\",\n     \"parent_id\": null\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/TagsController.php",
    "groupTitle": "Tags"
  },
  {
    "type": "get",
    "url": "v1/tags",
    "title": "List",
    "name": "tagsList",
    "group": "Tags",
    "version": "1.0.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": [\n     {\n      \"id\": 7,\n      \"title\": \"tag\"\n      },\n      {\n      \"id\": 25,\n     \"title\": \"tag title\"\n     },\n     {\n     \"id\": 28,\n      \"title\": \"tag title 2\"\n     }\n  ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/TagsController.php",
    "groupTitle": "Tags"
  },
  {
    "type": "get",
    "url": "v1/tags/:id",
    "title": "View",
    "name": "tagsView",
    "group": "Tags",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>Tag ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{\n\"success\": true,\n\"data\": {\n     \"id\": 28,\n     \"user\": 1,\n     \"title\": \"title of tag\",\n     \"parent_id\": null\n }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "../controllers/TagsController.php",
    "groupTitle": "Tags"
  }
] });
