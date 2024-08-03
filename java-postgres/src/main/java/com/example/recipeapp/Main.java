package com.example.recipeapp;

import java.util.Scanner;

public class Main {
    private static Scanner scanner = new Scanner(System.in);
    private static UserDAO userDAO = new UserDAO();
    private static RecipeDAO recipeDAO = new RecipeDAO();
    private static User loggedInUser = null;

    public static void main(String[] args) {
        while (true) {
            if (loggedInUser == null) {
                showLoginOrRegister();
            } else {
                showRecipeOptions();
            }
        }
    }

    private static void showLoginOrRegister() {
        System.out.println("1. Register");
        System.out.println("2. Login");
        System.out.println("3. Exit");

        int choice = scanner.nextInt();
        scanner.nextLine();  // consume newline

        switch (choice) {
            case 1:
                register();
                break;
            case 2:
                login();
                break;
            case 3:
                System.exit(0);
                break;
            default:
                System.out.println("Invalid choice. Please try again.");
        }
    }

    private static void showRecipeOptions() {
        System.out.println("1. Add Recipe");
        System.out.println("2. Update Recipe");
        System.out.println("3. Delete Recipe");
        System.out.println("4. List My Recipes");
        System.out.println("5. Logout");

        int choice = scanner.nextInt();
        scanner.nextLine();  // consume newline

        switch (choice) {
            case 1:
                addRecipe();
                break;
            case 2:
                updateRecipe();
                break;
            case 3:
                deleteRecipe();
                break;
            case 4:
                listMyRecipes();
                break;
            case 5:
                logout();
                break;
            default:
                System.out.println("Invalid choice. Please try again.");
        }
    }

    private static void register() {
        System.out.println("Enter username:");
        String username = scanner.nextLine();
        System.out.println("Enter password:");
        String password = scanner.nextLine();
        User user = new User(username, password);
        userDAO.saveUser(user);
        System.out.println("User registered successfully!");
    }

    private static void login() {
        System.out.println("Enter username:");
        String username = scanner.nextLine();
        System.out.println("Enter password:");
        String password = scanner.nextLine();
        User user = userDAO.getUserByUsername(username);
        if (user != null && user.getPassword().equals(password)) {
            loggedInUser = user;
            System.out.println("Login successful! Welcome, " + username);
        } else {
            System.out.println("Invalid username or password.");
        }
    }

    private static void logout() {
        System.out.println("Logged out successfully.");
        loggedInUser = null;
    }

    private static void addRecipe() {
        System.out.println("Enter recipe title:");
        String title = scanner.nextLine();
        System.out.println("Enter recipe description:");
        String description = scanner.nextLine();
        System.out.println("Enter recipe instructions:");
        String instructions = scanner.nextLine();

        Recipe recipe = new Recipe(title, description, instructions, loggedInUser.getId());
        recipeDAO.saveRecipe(recipe);
        System.out.println("Recipe added successfully!");
    }

    private static void updateRecipe() {
        System.out.println("Enter recipe ID to update:");
        int id = scanner.nextInt();
        scanner.nextLine();  // consume newline

        System.out.println("Enter new recipe title:");
        String title = scanner.nextLine();
        System.out.println("Enter new recipe description:");
        String description = scanner.nextLine();
        System.out.println("Enter new recipe instructions:");
        String instructions = scanner.nextLine();

        Recipe recipe = new Recipe(id, title, description, instructions, loggedInUser.getId());
        recipeDAO.updateRecipe(recipe);
        System.out.println("Recipe updated successfully!");
    }

    private static void deleteRecipe() {
        System.out.println("Enter recipe ID to delete:");
        int id = scanner.nextInt();
        scanner.nextLine();  // consume newline

        recipeDAO.deleteRecipe(id);
        System.out.println("Recipe deleted successfully!");
    }

    private static void listMyRecipes() {
        recipeDAO.getRecipesByUserId(loggedInUser.getId()).forEach(recipe -> {
            System.out.println("ID: " + recipe.getId());
            System.out.println("Title: " + recipe.getTitle());
            System.out.println("Description: " + recipe.getDescription());
            System.out.println("Instructions: " + recipe.getInstructions());
            System.out.println("-----------------------------");
        });
    }
}
