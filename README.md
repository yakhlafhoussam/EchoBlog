

# ✒️ EchoBlog

A structured blog management system designed using **OOP principles**, **UML modeling**, and **MVC architecture**.
The project focuses on **clean design**, **role-based access**, and **scalable architecture**.

---

## 📌 Project Context

This application manages a blog platform with **three types of users**:

* **Reader** – can read, comment and like content
* **Author** – creates and manages articles
* **Admin** – manages users, categories, and system moderation

All users inherit from a **common abstract `User` class**.

---

## 👥 System Roles

| Role   | Description                                       |
| ------ | ------------------------------------------------- |
| Reader | Reads articles, comments, likes                   |
| Author | Creates, deletes own articles                     |
| Admin  | Manages users, promotes roles, manages categories |

📌 *A user can only have one role at a time.*

---

## 🧱 Business Entities

* **User (abstract)**
* **Reader**
* **Author**
* **Admin**
* **Article**
* **Comment**
* **Category**
* **Like**

---

## 🔐 Functional Rules (Modeled)

* A user has **one role only**
* An article belongs to **one author**
* An article can have **multiple categories**
* An article can receive **multiple comments**
* A user can interact with **multiple articles**
* Category management is reserved for **Admin**
* A reader can be promoted to author **only by Admin approval**

---

## 🎯 Learning Objectives

* Object-Oriented Programming (OOP)
* Inheritance & abstraction
* UML (Use Case & Class Diagrams)
* MVC Architecture
* Relational database design
* SQL relationships (1–N, N–N)
* Clean and maintainable code structure

---

## 🏗️ Technical Architecture (Planned)

* MVC pattern
* PSR-4 Autoloading
* Namespaces
* Routing system
* Core folder for shared logic
* Clean separation of concerns


---

## 🛠️ Technologies (Planned)

* PHP (MVC-based)
* MySQL
* HTML / CSS / Tailwind
* UML (StarUML)

---

## Diagrams

### Use Case Diagram

![use case diagram](/UML/usecase.png)

### Class Diagram

![Class Diagram](/UML/class.png)

### ER Diagram

![Entity Relationship Diagram](/UML/erd.png)