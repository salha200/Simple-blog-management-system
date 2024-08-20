<?php

class Post {
    private $db;
    private $table = 'posts';

    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->db = $db;
    }

    // إنشاء مقالة جديدة
    public function create() {
        $sql = "INSERT INTO $this->table (title, content, author) VALUES (:title, :content, :author)";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([
            ':title' => $this->title,
            ':content' => $this->content,
            ':author' => $this->author
        ]);
        return $this->db->lastInsertId(); 
    }
    // قراءة مقالة حسب معرف
    public function read($id) {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([':id' => $id]); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    // تحديث مقالة موجودة
    public function update($id) {
        $sql = "UPDATE $this->table SET title = :title, content = :content, author = :author, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([
            ':title' => $this->title,
            ':content' => $this->content,
            ':author' => $this->author,
            ':id' => $id
        ]);
        return $stmt->rowCount(); 
    }
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([':id' => $id]); 
        return $stmt->rowCount(); 
    }
    // عرض جميع المقالات
    public function listAll() {
        $sql = "SELECT * FROM $this->table ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
