/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.choco.java;

import com.choco.java.constants;

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
@WebServlet(name = "mostRecentViewed", urlPatterns = {"/mostrecentviewed"})
public class mostRecentViewed extends HttpServlet {
    
    private constants cons = new constants();
    
    @Override
    public void init(ServletConfig config) throws ServletException {
        try {
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
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
        response.setContentType("text/html");
        
        HttpSession session = request.getSession(true);
        LinkedList<String> recentViewedItems = (LinkedList<String>) session.getAttribute("recentViewedItems");        
        
        try {            
            PrintWriter out = response.getWriter();
            try {
                
                conn = DriverManager.getConnection("jdbc:mysql://"+this.cons.getDB_HOST()+"/"+this.cons.getDB_DATABASE(), this.cons.getDB_USER(), this.cons.getDB_PASSWORD());
                String sql = "select * from chocolate where id = ?";
                prep = conn.prepareStatement(sql);
                if (recentViewedItems != null)
                    out.println("<div class=\"most-recent-viewed\"><h3>Most recent viewed items</h3></div>");
                
                for (String itemNum : recentViewedItems){
                    prep.setString(1,itemNum);
                    ResultSet rs = prep.executeQuery();
                    rs.next();
                    out.println(
        "<div class = \"item-block-small\">"+
        "<table>"+
            "<tbody >"+
                "<tr>"+
                    "<td><img class = \" enlarge-pic \" onclick=\" openItemPage("+rs.getString("id")+ ") \" src=\" "+rs.getString("img")+" \" /></td> "+
                "</tr>"+
                "<tr>"+
                    "<td><h3 class=\" item-title \"> "+rs.getString("name")+"</h3> </td> "+
                "</tr>"+
                "<tr>"+
                    "<td><h1> $"+rs.getString("price")+"</h1> </td>"+
                "</tr>"+
            "</tbody> "+
        "</table>"+
        "</div>");
                }
                
                out.println("<div class=\"most-recent-viewed\"><h3>All the items</h3></div>");
                
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
        
        this.doGet(request, response);
        
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
