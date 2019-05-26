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
 * @author siyunji
 */
@WebServlet(name = "checkOut", urlPatterns = {"/checkout"})
public class checkOut extends HttpServlet {
    private constants cons = new constants();

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
        HashMap<String, Integer> cart = (HashMap<String, Integer>) session.getAttribute("cart");        
        
        try {            
            PrintWriter out = response.getWriter();
            try {
                float total = 0;
                conn = DriverManager.getConnection("jdbc:mysql://"+this.cons.getDB_HOST()+"/"+this.cons.getDB_DATABASE(), this.cons.getDB_USER(), this.cons.getDB_PASSWORD());
                String sql = "select * from chocolate where id = ?";
                prep = conn.prepareStatement(sql);
                if (cart == null)
                    out.println("<h1>Cart is EMPTY, GO BUYING SOMTH</h1>");
                else{
                    for (String itemNum : cart.keySet()){
                    prep.setString(1,itemNum);
                    ResultSet rs = prep.executeQuery();
                    rs.next();
                    total += rs.getFloat("price")*cart.get(itemNum);
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
                                "<tr>"+
                                    "<td><h1> Quantity: "+cart.get(itemNum)+"</h1> </td>"+
                                "</tr>"+
                            "</tbody> "+
                        "   </table>"+
                        "</div>");
                    }
                    out.println("<h1>Total Price: "+total+"</h1>");
                }
            

                
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
        // posting the order form
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
