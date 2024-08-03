package com.example.recipeapp;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class RecipeDAO {
    public void saveRecipe(Recipe recipe) {
        String sql = "INSERT INTO recipes (title, description, instructions, user_id) VALUES (?, ?, ?, ?)";

        try (Connection connection = DBConnection.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {
            statement.setString(1, recipe.getTitle());
            statement.setString(2, recipe.getDescription());
            statement.setString(3, recipe.getInstructions());
            statement.setInt(4, recipe.getUserId());
            statement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void updateRecipe(Recipe recipe) {
        String sql = "UPDATE recipes SET title = ?, description = ?, instructions = ? WHERE id = ?";

        try (Connection connection = DBConnection.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {
            statement.setString(1, recipe.getTitle());
            statement.setString(2, recipe.getDescription());
            statement.setString(3, recipe.getInstructions());
            statement.setInt(4, recipe.getId());
            statement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void deleteRecipe(int id) {
        String sql = "DELETE FROM recipes WHERE id = ?";

        try (Connection connection = DBConnection.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {
            statement.setInt(1, id);
            statement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public List<Recipe> getAllRecipes() {
        List<Recipe> recipes = new ArrayList<>();
        String sql = "SELECT * FROM recipes";

        try (Connection connection = DBConnection.getConnection();
             Statement statement = connection.createStatement();
             ResultSet resultSet = statement.executeQuery(sql)) {
            while (resultSet.next()) {
                Recipe recipe = new Recipe();
                recipe.setId(resultSet.getInt("id"));
                recipe.setTitle(resultSet.getString("title"));
                recipe.setDescription(resultSet.getString("description"));
                recipe.setInstructions(resultSet.getString("instructions"));
                recipe.setUserId(resultSet.getInt("user_id"));
                recipes.add(recipe);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return recipes;
    }

    public List<Recipe> getRecipesByUserId(int userId) {
        List<Recipe> recipes = new ArrayList<>();
        String sql = "SELECT * FROM recipes WHERE user_id = ?";

        try (Connection connection = DBConnection.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {
            statement.setInt(1, userId);
            ResultSet resultSet = statement.executeQuery();
            while (resultSet.next()) {
                Recipe recipe = new Recipe();
                recipe.setId(resultSet.getInt("id"));
                recipe.setTitle(resultSet.getString("title"));
                recipe.setDescription(resultSet.getString("description"));
                recipe.setInstructions(resultSet.getString("instructions"));
                recipe.setUserId(resultSet.getInt("user_id"));
                recipes.add(recipe);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return recipes;
    }
}
