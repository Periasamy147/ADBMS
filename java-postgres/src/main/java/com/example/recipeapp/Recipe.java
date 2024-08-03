package com.example.recipeapp;

public class Recipe {
    private int id;
    private String title;
    private String description;
    private String instructions;
    private int userId;

    public Recipe() {}

    public Recipe(String title, String description, String instructions, int userId) {
        this.title = title;
        this.description = description;
        this.instructions = instructions;
        this.userId = userId;
    }

    public Recipe(int id, String title, String description, String instructions, int userId) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.instructions = instructions;
        this.userId = userId;
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getInstructions() {
        return instructions;
    }

    public void setInstructions(String instructions) {
        this.instructions = instructions;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }
}
