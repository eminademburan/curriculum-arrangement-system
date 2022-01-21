package com.company;

import com.mysql.cj.protocol.Resultset;

import java.sql.*;

public class DBConnector {

    public static void main(String[] args) {
        try{
            Class.forName("com.mysql.cj.jdbc.Driver");
        }
        catch(ClassNotFoundException e){
            System.out.println("MwSQL JDBC Driver can not be found");
            e.printStackTrace();
        }

        final String UserName = "adem.buran";
        final String Password = "Yfle8psq";
        final String DBName = "adem_buran";
        final String URL = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/" + DBName;

        Connection connection = null;

        try{
            //try to connect database
            connection = DriverManager.getConnection(URL, UserName, Password);
        }
        catch(SQLException e){
            System.out.println("CONNECTION FAIL!");
            e.printStackTrace();
        }

        if( connection != null)
            System.out.println("Connection established successfully");
        else
            System.out.println("Connection failed ");

        Statement s;

        try{
            s = connection.createStatement();
            s.executeUpdate("DROP TABLE IF EXISTS apply");
            s.executeUpdate("DROP TABLE IF EXISTS student");
            s.executeUpdate("DROP TABLE IF EXISTS company");

            //create student table
            s.executeUpdate( "CREATE TABLE student(" +
                    "sid CHAR(12)," +
                    "sname VARCHAR(50)," +
                    "bdate DATE," +
                    "address VARCHAR(50)," +
                    "scity VARCHAR(20)," +
                    "year CHAR(20)," +
                    "gpa FLOAT," +
                    "nationality VARCHAR(20)," +
                    "PRIMARY KEY(sid))" +
                    "ENGINE=innodb;"
            );
            System.out.println("student table has been created successfully");

            //create company table
            s.executeUpdate( "CREATE TABLE company(" +
                    "cid CHAR(8)," +
                    "cname VARCHAR(20)," +
                    "quota INT," +
                    "PRIMARY KEY(cid))" +
                    "ENGINE=innodb;"
            );

            System.out.println("company table has been created successfully");

            //create apply table
            s.executeUpdate("CREATE TABLE apply(" +
                    "sid CHAR(12)," +
                    "cid CHAR(8)," +
                    "PRIMARY KEY(sid,cid)," +
                    "FOREIGN KEY (sid) REFERENCES student(sid)," +
                    "FOREIGN KEY (cid) REFERENCES company(cid))" +
                    "ENGINE=innodb;"
            );

            System.out.println("apply table has been created successfully");

            //make necessary insertions to student table
            s.executeUpdate("INSERT INTO student VALUES" +
                "('21000001', 'John', '1999-05-14', 'Windy', 'Chicago', 'senior', 2.33, 'US'), " +
                "('21000002', 'Ali', '2001-09-30', 'Nisantasi', 'Istanbul', 'junior', 3.26, 'TC'), " +
                "('21000003', 'Veli', '2003-02-25', 'Nisantasi', 'Istanbul', 'freshman', 2.41, 'TC'), " +
                "('21000004', 'Ayse', '2003-01-15', 'Tunali', 'Ankara', 'freshman', 2.55, 'TC'); "
            );
            System.out.println("values have been added to student table successfully");

            //make necessary insertions to company table
            s.executeUpdate("INSERT INTO company VALUES" +
                    "( 'C101', 'microsoft', 2)," +
                    "( 'C102', 'merkez bankasi', 5)," +
                    "( 'C103', 'tai', 3)," +
                    "( 'C104', 'tubitak', 5)," +
                    "( 'C105', 'aselsan', 3)," +
                    "( 'C106', 'havelsan', 4)," +
                    "( 'C107', 'milsoft', 2);"
            );
            System.out.println("values have been added to company table successfully");

            //make necessary insertions to student table
            s.executeUpdate("INSERT INTO apply VALUES" +
                    "( '21000001', 'C101')," +
                    "( '21000001', 'C102')," +
                    "( '21000001', 'C103')," +
                    "( '21000002', 'C101')," +
                    "( '21000002', 'C105')," +
                    "( '21000003', 'C104')," +
                    "( '21000003', 'C105')," +
                    "( '21000004', 'C107');"
            );
            System.out.println("values have been added to apply table successfully");

            //print student table
            System.out.println("--------------------------------------------------student table-----------------------------------------------------");

            System.out.printf("%12s | %12s | %12s | %12s | %12s | %12s | %12s | %12s%n", "sid", "sname", "bdate", "address", "scity", "year", "gpa", "nationality");

            //make student query
            ResultSet students = s.executeQuery("SELECT * FROM student");

            while( students.next())
                System.out.printf("%12s | %12s | %12s | %12s | %12s | %12s | %12s | %12s%n", students.getString(1),
                        students.getString(2),students.getString(3),students.getString(4),students.getString(5),
                        students.getString(6),students.getString(7), students.getString(8));



        }

        catch(SQLException e){
            System.out.println("SQL Exception");
            e.printStackTrace();
        }

    }
}
