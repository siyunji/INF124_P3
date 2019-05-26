/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.choco.java;

import com.choco.java.constants;
import java.util.*;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpSession;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author niuni
 */
@WebServlet(name = "storeItems", urlPatterns = {"/storeitems"})
public class storeItems extends HttpServlet {
    
    private constants cons = new constants();

    @Override
    public void init(ServletConfig config) throws ServletException {
        try {
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }
    }
    
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        Connection conn = null;
        Statement stmt = null;
        PreparedStatement prep = null; 
        
        try {            
            PrintWriter out = response.getWriter();
            try {
                conn = DriverManager.getConnection("jdbc:mysql://"+this.cons.getDB_HOST()+"/"+this.cons.getDB_DATABASE(), this.cons.getDB_USER(), this.cons.getDB_PASSWORD());
                String sql = "select * from chocolate where id = ?";
                prep = conn.prepareStatement(sql);
                
                
                //output the detail of product
               
                
            } catch (Exception e) {
                response.sendError(500);
            } finally {
                if (stmt != null)
                    stmt.close();
                if (conn != null)
                    conn.close();
                if (prep != null)
                    prep.close();
            }
            
        } catch (SQLException e) {
            response.sendError(500);
        }
    
    }
    
    

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        response.setContentType("text/html");   
        
        try {         
            
            //add item and quantity into cart
            HttpSession session = request.getSession(true);
            HashMap<String, Integer> cart = (HashMap<String, Integer>) session.getAttribute("cart");
            if (cart == null){
                session.setAttribute("cart", new HashMap<String, Integer>());
                cart = (HashMap<String, Integer>) session.getAttribute("cart");
            }
            
            String itemNum = request.getParameter("num");
            Integer quantity = Integer.valueOf(request.getParameter("quantity"));
            if (cart.containsKey(itemNum)){
                cart.replace(itemNum, cart.get(itemNum)+quantity);
            } else{
                cart.put(itemNum, quantity);
            }
            
            response.sendRedirect("/java/html/shop.html");
            
        } catch (Exception e) {
                response.sendError(500);
        }
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
