import java.sql.*;

public class App {
    public static void main(String[] args) throws Exception {
        try {

            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (ClassNotFoundException e) {

            System.out.println("JDBC Driver NOT FOUND!");
        }

        // final String dbName = "dbproject";
        // final String URL = "jdbc:mysql://localhost:3306/" + dbName;
        // final String user = "root";
        // final String pass = "";
        final String user; // = "eylul.caglar";
        final String pass; // = "GwHo8l2b";
        final String dbName; // = "";
        final String URL; // = "" + database;

        user = "eylul.caglar";
        pass = "GwHo8l2b";
        dbName = "eylul_caglar";
        URL = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/" + dbName;

        Connection con = null;
        Statement stmt = null;

        try {
            con = DriverManager.getConnection(URL, user, pass);
            if (con != null) {
                System.out.println("SUCCESFUL CONNECTION");
            } else {
                System.out.println("CANNOT CONNECT");
            }
        } catch (SQLException e) {
            System.out.println("CANNOT CONNECT2");
            // e.printStackTrace();
        }

        // SQL Part
        try {
            stmt = con.createStatement();

            // //drop tables

            String sql = "DROP TABLE IF EXISTS tour_activity";
            stmt.executeUpdate(sql);
            System.out.println("tour_activity table is deleted!");

            sql = "DROP TABLE IF EXISTS guide_evaluate_tour";
            stmt.executeUpdate(sql);
            System.out.println("guide_evaluate_tour table is deleted!");

            sql = "DROP TABLE IF EXISTS tour_guide";
            stmt.executeUpdate(sql);
            System.out.println("tour_guide table is deleted!");

            sql = "DROP TABLE IF EXISTS tour_guide_decline";
            stmt.executeUpdate(sql);
            System.out.println("tour_guide_decline table is deleted!");

            sql = "DROP TABLE IF EXISTS evaluate_guide";
            stmt.executeUpdate(sql);
            System.out.println("evaluate_guide table is deleted!");

            sql = "DROP TABLE IF EXISTS evaluate_tour";
            stmt.executeUpdate(sql);
            System.out.println("evaluate_tour table is deleted!");

            sql = "DROP TABLE IF EXISTS tour_bucket";
            stmt.executeUpdate(sql);
            System.out.println("tour_bucket table is deleted!");

            sql = "DROP TABLE IF EXISTS tour_activity_bucket";
            stmt.executeUpdate(sql);
            System.out.println("tour_activity_bucket table is deleted!");

            sql = "DROP TABLE IF EXISTS reservation_tour_activity";
            stmt.executeUpdate(sql);
            System.out.println("reservation_tour_activity table is deleted!");

            sql = "DROP TABLE IF EXISTS hotel_bucket";
            stmt.executeUpdate(sql);
            System.out.println("hotel_bucket table is deleted!");

            sql = "DROP TABLE IF EXISTS flight_bucket";
            stmt.executeUpdate(sql);
            System.out.println("flight_bucket table is deleted!");

            sql = "DROP TABLE IF EXISTS employee_reserve";
            stmt.executeUpdate(sql);
            System.out.println("employee_reserve table is deleted!");

            sql = "DROP TABLE IF EXISTS customer_reserve";
            stmt.executeUpdate(sql);
            System.out.println("customer_reserve table is deleted!");

            sql = "DROP TABLE IF EXISTS hotel_evaluation";
            stmt.executeUpdate(sql);
            System.out.println("hotel_evaluation table is deleted!");

            sql = "DROP TABLE IF EXISTS reservation_tour";
            stmt.executeUpdate(sql);
            System.out.println("reservation_tour table is deleted!");

            sql = "DROP TABLE IF EXISTS reservation_hotel";
            stmt.executeUpdate(sql);
            System.out.println("reservation_hotel table is deleted!");

            sql = "DROP TABLE IF EXISTS Hotel_Room";
            stmt.executeUpdate(sql);
            System.out.println("Hotel_Room table is deleted!");

            sql = "DROP TABLE IF EXISTS Employee";
            stmt.executeUpdate(sql);
            System.out.println("Employee table is deleted!");

            // sql = "DROP TABLE IF EXISTS Customer_Ticket";
            // stmt.executeUpdate(sql);
            // System.out.println("Customer_Ticket table is deleted!");

            sql = "DROP TABLE IF EXISTS Flight_Ticket";
            stmt.executeUpdate(sql);
            System.out.println("Flight_Ticket table is deleted!");

            sql = "DROP TABLE IF EXISTS guide";
            stmt.executeUpdate(sql);
            System.out.println("guide table is deleted!");

            sql = "DROP TABLE IF EXISTS Flight";
            stmt.executeUpdate(sql);
            System.out.println("Flight table is deleted!");

            sql = "DROP TABLE IF EXISTS Airport";
            stmt.executeUpdate(sql);
            System.out.println("Airport table is deleted!");

            sql = "DROP TABLE IF EXISTS Hotel";
            stmt.executeUpdate(sql);
            System.out.println("Hotel table is deleted!");

            sql = "DROP TABLE IF EXISTS tour_city";
            stmt.executeUpdate(sql);
            System.out.println("tour_city table is deleted!");

            sql = "DROP TABLE IF EXISTS city";
            stmt.executeUpdate(sql);
            System.out.println("city table is deleted!");

            sql = "DROP TABLE IF EXISTS tour";
            stmt.executeUpdate(sql);
            System.out.println("tour table is deleted!");

            sql = "DROP TABLE IF EXISTS activity";
            stmt.executeUpdate(sql);
            System.out.println("activity table is deleted!");

            sql = "DROP TABLE IF EXISTS reservation";
            stmt.executeUpdate(sql);
            System.out.println("reservation table is deleted!");

            sql = "DROP VIEW IF EXISTS tourReservations";
            stmt.executeUpdate(sql);
            System.out.println("tourReservations table is deleted!");

            sql = "DROP TABLE IF EXISTS customer";
            stmt.executeUpdate(sql);
            System.out.println("customer table is deleted!");

            sql = "DROP TABLE IF EXISTS account";
            stmt.executeUpdate(sql);
            System.out.println("account table is deleted!");

            // create tables

            // Missing Foreign Key, will be added
            sql = "CREATE TABLE account " +
                    "(user_id INT(12) AUTO_INCREMENT, " +
                    " username VARCHAR(50), " +
                    " password VARCHAR(50), " +
                    " email VARCHAR(50), " +
                    " phone_num VARCHAR(50), " +
                    " fname VARCHAR(50), " +
                    " PRIMARY KEY ( user_id ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("account table created!");

            sql = "CREATE TABLE customer " +
                    "(customer_id INT(12), " +
                    " PRIMARY KEY ( customer_id ), " +
                    " FOREIGN KEY (customer_id) REFERENCES account(user_id) ON DELETE CASCADE) " +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("customer table created!");

            sql = "CREATE TABLE Employee " +
                    "(employee_id INT(12), " +
                    " PRIMARY KEY ( employee_id ), " +
                    " FOREIGN KEY (employee_id) REFERENCES account(user_id) ON DELETE CASCADE) " +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Employee table created!");

            sql = "CREATE TABLE guide " +
                    "(guide_id INT(12), " +
                    " PRIMARY KEY ( guide_id ), " +
                    " FOREIGN KEY (guide_id) REFERENCES account(user_id) ON DELETE CASCADE) " +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("guide table created!");

            sql = "CREATE TABLE activity " +
                    "(activity_id INT(12) AUTO_INCREMENT, " +
                    " content VARCHAR(255), " +
                    " name VARCHAR(255), " +
                    " location VARCHAR(255), " +
                    " price FLOAT(12,2), " +
                    " categories VARCHAR(255), " +
                    " image VARCHAR(255), " +
                    " PRIMARY KEY ( activity_id ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("activity table created!");

            sql = "CREATE TABLE tour " +
                    "(tour_id INT(12) AUTO_INCREMENT, " +
                    " start_date DATE, " +
                    " end_date DATE, " +
                    " tour_information VARCHAR(255), " +
                    " image VARCHAR(255), " +
                    " tour_name VARCHAR(255), " +
                    " cost VARCHAR(255), " +
                    " PRIMARY KEY ( tour_id ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("tour table created!");

            sql = "ALTER TABLE `tour` ADD INDEX( `start_date`, `end_date`)";
            stmt.executeUpdate(sql);
            System.out.println("Secondary indices tour table updated!");

            sql = "CREATE TABLE tour_guide " +
                    "(tour_id INT(12), " +
                    " guide_id INT(12), " +
                    " acceptance_status INT(12), " +
                    " reason CHAR(255), " +
                    " FOREIGN KEY (guide_id) REFERENCES guide(guide_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE, " +
                    " PRIMARY KEY ( tour_id, guide_id ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("tour_guide table created!");

            sql = "CREATE TABLE city " +
                    "(city_id INT(12) AUTO_INCREMENT, " +
                    " city_name VARCHAR(255), " +
                    " PRIMARY KEY ( city_id ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("city table created!");

            sql = "CREATE TABLE tour_city " +
                    "(city_id INT(12), " +
                    "tour_id INT(12), " +
                    " FOREIGN KEY (city_id) REFERENCES city(city_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE, " +
                    " PRIMARY KEY ( city_id, tour_id ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("tour_city table created!");

            sql = "CREATE TABLE tour_activity " +
                    "(activity_id INT(12), " +
                    " tour_id INT(12), " +
                    " date DATE, " +
                    " PRIMARY KEY ( activity_id, tour_id ), " +
                    " FOREIGN KEY (activity_id) REFERENCES activity(activity_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("tour_activity table created!");

            sql = "CREATE TABLE evaluate_tour " +
                    "(evalutaion_id INT(12) AUTO_INCREMENT, " +
                    " tour_id INT(12), " +
                    " customer_id INT(12), " +
                    " rate INT(12), " +
                    " evaluation VARCHAR(255), " +
                    " PRIMARY KEY ( evalutaion_id ), " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("evaluate_tour table created!");

            sql = "CREATE TABLE evaluate_guide " +
                    "(evalutaion_id INT(12) AUTO_INCREMENT, " +
                    " guide_id INT(12), " +
                    " customer_id INT(12), " +
                    " rate INT(12), " +
                    " evaluation VARCHAR(255), " +
                    " PRIMARY KEY ( evalutaion_id ), " +
                    " FOREIGN KEY (guide_id) REFERENCES guide(guide_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("evaluate_guide table created!");

            sql = "CREATE TABLE guide_evaluate_tour " +
                    "(evalutaion_id INT(12) AUTO_INCREMENT, " +
                    " guide_id INT(12), " +
                    " tour_id INT(12), " +
                    " rate INT(12), " +
                    " evaluation VARCHAR(255), " +
                    " PRIMARY KEY ( evalutaion_id ), " +
                    " FOREIGN KEY (guide_id) REFERENCES guide(guide_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("guide_evaluate_tour table created!");

            sql = "CREATE TABLE Airport " +
                    "(airport_id INT(12) AUTO_INCREMENT, " +
                    " city varchar(255), " +
                    " PRIMARY KEY ( airport_id ))" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Airport table created!");

            sql = "CREATE TABLE Flight " +
                    "(flight_id INT(12) AUTO_INCREMENT, " +
                    " departure_time DATETIME, " +
                    " arrival_time DATETIME, " +
                    " departure_airport INT(12), " +
                    " arrival_airport INT(12), " +
                    " cost INT(12), " +
                    " PRIMARY KEY ( flight_id ), " +
                    " FOREIGN KEY (departure_airport) REFERENCES Airport(airport_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (arrival_airport) REFERENCES Airport(airport_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Flight table created!");

            sql = "CREATE TABLE Flight_Ticket " +
                    "(ticket_id INT(12) AUTO_INCREMENT, " +
                    " customer_id INT(12), " +
                    " flight_id INT(12), " +
                    " count INT(12), " +
                    " PRIMARY KEY (ticket_id), " +
                    " FOREIGN KEY (flight_id) REFERENCES Flight(flight_id) ON DELETE CASCADE," +
                    " FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Flight_Ticket table created!");

            // sql = "CREATE TABLE Customer_Ticket " +
            // "(ticket_id INT(12), " +
            // " customer_id INT(12), " +
            // " PRIMARY KEY (ticket_id, customer_id), " +
            // " FOREIGN KEY (ticket_id) REFERENCES Flight_Ticket(ticket_id)," +
            // " FOREIGN KEY (customer_id) REFERENCES Customer(customer_id))" +
            // " ENGINE=innodb;";

            // stmt.executeUpdate(sql);
            // System.out.println("Customer_Ticket table created!");

            sql = "CREATE TABLE Hotel " +
                    "(hotel_id INT(12) AUTO_INCREMENT, " +
                    " name varchar(50), " +
                    " city varchar(50), " +
                    " star INT(12), " +
                    " details VARCHAR(255), " +
                    " image VARCHAR(255), " +
                    " price FLOAT, " +
                    " people_rated INT(12), " +
                    " total_rate INT(12), " +
                    " PRIMARY KEY ( hotel_id )) " +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Hotel table created!");

            sql = "CREATE TABLE Hotel_Room " +
                    "(room_id INT(12) AUTO_INCREMENT, " +
                    " amount_of_people INT(12), " +
                    " type varchar(50), " +
                    " price FLOAT, " +
                    " hotel_id INT(12), " +
                    " FOREIGN KEY (hotel_id) REFERENCES Hotel(hotel_id) ON DELETE CASCADE, " +
                    " PRIMARY KEY ( room_id )) " +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Hotel_Room table created!");

            sql = "CREATE TABLE reservation " +
                    "(reservation_id INT(12) AUTO_INCREMENT, " +
                    " PRIMARY KEY ( reservation_id )) " +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("reservation table created!");

            sql = "CREATE TABLE reservation_hotel " +
                    "(reservation_id INT(12), " +
                    " hotel_id INT(12), " +
                    " reservation_type varchar(50), " +
                    " amount_of_people INT(12), " +
                    " start_date DATE, " +
                    " end_date DATE, " +
                    " PRIMARY KEY ( reservation_id ), " +
                    " FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (hotel_id) REFERENCES Hotel(hotel_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("reservation_hotel table created!");

            sql = "CREATE TABLE reservation_tour " +
                    "(reservation_id INT(12), " +
                    " tour_id INT(12), " +
                    " amount_of_people INT(12), " +
                    " PRIMARY KEY ( reservation_id ), " +
                    " FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("reservation_tour table created!");

            // NORMALDE BURADA USER ID YOK --> EMPLOYEE ID VE CUSTOMER ID VAR
            sql = "CREATE TABLE employee_reserve " +
                    "(reservation_id INT(12), " +
                    " employee_id INT(12), " +
                    " customer_id INT(12), " +
                    " PRIMARY KEY ( reservation_id, employee_id, customer_id), " +
                    " FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (employee_id) REFERENCES account(user_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (customer_id) REFERENCES account(user_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("employee_reserve table created!");

            sql = "CREATE TABLE customer_reserve " +
                    "(reservation_id INT(12), " +
                    " customer_id INT(12), " +
                    " acceptance_status INT(12), " +
                    " reason VARCHAR(255), " +
                    " PRIMARY KEY ( reservation_id, customer_id), " +
                    " FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (customer_id) REFERENCES account(user_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("customer_reserve table created!");

            sql = "CREATE TABLE hotel_evaluation " +
                    "(evalutaion_id INT(12) AUTO_INCREMENT, " +
                    " customer_id INT(12), " +
                    " hotel_id INT(12), " +
                    " rate INT(12), " +
                    " evaluation VARCHAR(255), " +
                    " PRIMARY KEY ( evalutaion_id ), " +
                    " FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (hotel_id) REFERENCES Hotel(hotel_id) ON DELETE CASCADE) " +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("hotel_evaluation table created!");

            sql = "CREATE TABLE tour_bucket " +
                    "(user_id INT(12), " +
                    " tour_id INT(12), " +
                    " count INT(12), " +
                    " PRIMARY KEY ( user_id, tour_id ), " +
                    " FOREIGN KEY (user_id) REFERENCES account(user_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("tour_bucket table created!");

            sql = "CREATE TABLE tour_activity_bucket " +
                    "(user_id INT(12), " +
                    " tour_id INT(12), " +
                    " activity_id INT(12), " +
                    " count INT(12), " +
                    " PRIMARY KEY ( user_id, tour_id, activity_id ), " +
                    " FOREIGN KEY (user_id) REFERENCES account(user_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (activity_id) REFERENCES activity(activity_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("activity_bucket table created!");

            sql = "CREATE TABLE reservation_tour_activity " +
                    "(user_id INT(12), " +
                    " tour_id INT(12), " +
                    " activity_id INT(12), " +
                    " count INT(12), " +
                    " PRIMARY KEY ( user_id, tour_id, activity_id ), " +
                    " FOREIGN KEY (user_id) REFERENCES account(user_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (activity_id) REFERENCES activity(activity_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (tour_id) REFERENCES tour(tour_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("reservation_tour_activity table created!");

            sql = "CREATE TABLE hotel_bucket " +
                    "(user_id INT(12), " +
                    " hotel_id INT(12), " +
                    " count INT(12), " +
                    " start_date DATE, " +
                    " end_date DATE, " +
                    " PRIMARY KEY ( user_id, hotel_id ), " +
                    " FOREIGN KEY (user_id) REFERENCES account(user_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (hotel_id) REFERENCES Hotel(hotel_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("hotel_bucket table created!");

            sql = "CREATE TABLE flight_bucket " +
                    "(user_id INT(12), " +
                    " flight_id INT(12), " +
                    " count INT(12), " +
                    " PRIMARY KEY ( user_id, flight_id ), " +
                    " FOREIGN KEY (user_id) REFERENCES account(user_id) ON DELETE CASCADE, " +
                    " FOREIGN KEY (flight_id) REFERENCES Flight(flight_id) ON DELETE CASCADE)" +
                    " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("flight_bucket table created!");

            // Tour(tour_id, start_date, end_date, tour_information)
            // Tour_Activity (activity_id, tour_id, date)
            // Activity (activity_id, content, name, location, price, categories)

            // VIEWS
            sql = "CREATE VIEW tourReservations AS SELECT * FROM customer_reserve NATURAL JOIN reservation_tour NATURAL JOIN tour";
            stmt.executeUpdate(sql);
            System.out.println("tourReservations View created!");

            sql = "INSERT INTO account " +
                    "VALUES (null, 'kerem', '123', 'kerema', '05409981232', 'Kerem Alemdar')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO customer " +
                    "VALUES ('1')";
            stmt.executeUpdate(sql);

            System.out.println("checkpoint1");

            // insert tuples to tour
            sql = "INSERT INTO tour(tour_id, start_date, end_date, tour_information, image, tour_name, cost) " +
                    "VALUES (null, '2022/01/01', '2022/01/02', 'We will drink tea near blacksea and eat kebap', 'tour1.jpg', 'Blacksea Tour', 100)";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint2");
            
            sql = "INSERT INTO tour(tour_id, start_date, end_date, tour_information, image, tour_name, cost) " +
                    "VALUES (null, '2022/02/03', '2022/02/05', 'We will pray to garlic breads and light candles', 'tour1.jpg', 'France Tour', 150)";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint3");

            sql = "INSERT INTO tour(tour_id, start_date, end_date, tour_information, image, tour_name, cost) " +
                    "VALUES (null, '2022/02/02', '2022/02/03', 'Loire Valley will be visited in details with an informative guide', 'tour2.jpg', 'Loire Valley Tour', 220)";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint4");

            sql = "INSERT INTO tour(tour_id, start_date, end_date, tour_information, image, tour_name, cost) " +
                    "VALUES (null, '2022/02/01', '2022/02/03', 'This tour is in istanbul', 'tour1.jpg', 'Istanbul Tour', 320)";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint5");

            sql = "INSERT INTO tour(tour_id, start_date, end_date, tour_information, image, tour_name, cost) " +
                    "VALUES (null, '2022/01/05', '2022/01/08', 'Visiting Ankara castle and Anitkabir', 'tour2.jpg', 'Ankara Tour', 380)";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint6");

            sql = "INSERT INTO tour(tour_id, start_date, end_date, tour_information, image, tour_name, cost) " +
                    "VALUES (null, '2021/01/05', '2021/01/08', 'Swimming in Denizli and eating corn', 'tour2.jpg', 'Denizli Tour', 340)";
            stmt.executeUpdate(sql);


            System.out.println("checkpoint7");

            // insert tuples to activity
            sql = "INSERT INTO activity " +
                    "VALUES (null, 'A nature walk will be held, barbecue will be lit and sausage will be fried towards noon.', 'Nature walking', 'Ankara Mountain', 100, 'Nature, Walking, Sausage, Mountain, Ankara', 'activity1.jpg')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO activity " +
                    "VALUES (null, 'You will go up the mountain with the cable car and go around for 30 minutes. Cafes and places to eat will be shown. Afterwards, we will have an instructional ski lesson down the mountain.', 'Ski Tour', 'Erciyes Mountain', 150, 'Snow, Ski, Mountain, Erciyes', 'activity2.jpg')";
            stmt.executeUpdate(sql);

            System.out.println("checkpoint8");

            // insert tuples to tour_activity
            sql = "INSERT INTO tour_activity " +
                    "VALUES ('1', '1', '1998/11/20')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_activity " +
                    "VALUES ('1', '2', '1999/01/20')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_activity " +
                    "VALUES ('2', '1', '2020/08/13')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_activity " +
                    "VALUES ('2', '2', '2021/11/20')";
            stmt.executeUpdate(sql);

            System.out.println("checkpoint9");

            // insert tuples to Airport
            sql = "INSERT INTO Airport (city) " +
                    "VALUES ( 'Ankara' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
                    "VALUES ( 'Istanbul' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
                    "VALUES ( 'Bolu' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
                    "VALUES ( 'Roma' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
                    "VALUES ( 'Denizli' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
                    "VALUES ( 'London' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
                    "VALUES ( 'New York' )";
            stmt.executeUpdate(sql);

            System.out.println("checkpoint10");

            // insert tuples to Hotel
            sql = "INSERT INTO Hotel (hotel_id, name, city, star, details, image, price, people_rated, total_rate) " +
                    "VALUES ( null, 'Bilkent Hotel', 'Ankara', '3', 'Located 2 km from Bilkent University, this modern and cozy hotel is 14 km from the Anitkabir, and the iconic Kocatepe Mosque.', 'bilkent_hotel.jpg', '100.00', '2', '9' )";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint81");

            sql = "INSERT INTO Hotel (hotel_id, name, city, star, details, image, price, people_rated, total_rate) " +
                    "VALUES ( null, 'Kerem Hotel', 'Sakarya', '5', 'Located in Sakarya, good location.', 'kerem_hotel.jpg', '200', '0', '0' )";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint82");

            sql = "INSERT INTO Hotel (hotel_id, name, city, star, details, image, price, people_rated, total_rate) " +
                    "VALUES ( null, 'Ismet Hotel', 'Denizli', '2', 'Located in Denizli, good rooms.', 'ismet_hotel.jpg', '300', '0', '0' )";
            stmt.executeUpdate(sql);
            System.out.println("checkpoint83");

            System.out.println("checkpoint11");

            // insert tuples to bucket
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport, cost) " +
                    "VALUES ( '2022/01/25 13:30:00', '2022/01/25 15:30:00', '1', '2', '240')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport, cost) " +
                    "VALUES ( '2022/01/25 13:30:00', '2022/01/25 15:30:00', '1', '3', '340')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport, cost) " +
                    "VALUES ( '2022/01/25 13:30:00', '2022/01/25 15:30:00', '1', '4', '440')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport, cost) " +
                    "VALUES ( '2022/01/25 13:30:00', '2022/01/25 15:30:00', '1', '5', '240')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport, cost) " +
                    "VALUES ( '2022/01/25 13:30:00', '2022/01/25 15:30:00', '1', '6', '540')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport, cost) " +
                    "VALUES ( '2022/01/26 13:30:00', '2022/01/26 15:30:00', '1', '7', '740')";
            stmt.executeUpdate(sql);

        
            System.out.println("checkpoint12");

            sql = "INSERT INTO account " +
                    "VALUES (null, 'eylul', '1234', 'eylula', '05555555555', 'Eylul Caglar')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO guide (guide_id) " +
                    "VALUES ('2')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO tour_guide ( tour_id, guide_id, acceptance_status) " +
                    "VALUES ('1', '2', '1')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO tour_guide ( tour_id, guide_id, acceptance_status) " +
                    "VALUES ('5', '2', '2')";
            stmt.executeUpdate(sql);

            // HOTEL RESERVATIONS
            sql = "INSERT INTO reservation (reservation_id) " +
                    "VALUES (null)";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO reservation (reservation_id) " +
                    "VALUES (null)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_hotel (reservation_id, hotel_id, reservation_type, amount_of_people, start_date, end_date)"
                    +
                    "VALUES ( '1', '1', 'luxury', '3', '2021/12/25 15:30:00', '2021/12/30 15:30:00' )";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_hotel (reservation_id, hotel_id, reservation_type, amount_of_people, start_date, end_date)"
                    +
                    "VALUES ( '2', '2', 'luxury', '4', '2022/12/25 15:30:00', '2022/12/30 15:30:00' )";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO customer_reserve (reservation_id, customer_id, acceptance_status) " +
                    "VALUES ( '1', '1', '1')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO customer_reserve (reservation_id, customer_id, acceptance_status) " +
                    "VALUES ( '2', '1', '1')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation (reservation_id) " +
                    "VALUES (null)";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO reservation_hotel (reservation_id, hotel_id, reservation_type, amount_of_people, start_date, end_date)"
                    +
                    "VALUES ( '3', '2', 'luxury', '3', '2022/12/25 15:30:00', '2022/12/30 15:30:00' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO customer_reserve (reservation_id, customer_id, acceptance_status, reason) " +
                    "VALUES ( '3', '1','0','There is no place')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation (reservation_id) " +
                    "VALUES (null)";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO reservation_hotel (reservation_id, hotel_id, reservation_type, amount_of_people, start_date, end_date)"
                    +
                    "VALUES ( '4', '3', 'luxury', '3', '2022/12/25 15:30:00', '2022/12/27 15:30:00' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO customer_reserve (reservation_id, customer_id, acceptance_status) " +
                    "VALUES ( '4', '1', '2')";
            stmt.executeUpdate(sql);

            // TOUR RESERVATIONS
            sql = "INSERT INTO reservation (reservation_id) " +
                    "VALUES (null)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO customer_reserve (reservation_id, customer_id, acceptance_status) " +
                    "VALUES ( '5', '1','2')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_tour (reservation_id, tour_id, amount_of_people) " +
                    "VALUES ( '5', '1','3')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_tour_activity (user_id, tour_id, activity_id, count) " +
                    "VALUES ( '1', '1','1','3')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO reservation_tour_activity (user_id, tour_id, activity_id, count) " +
                    "VALUES ( '1', '1','2','4')";
            stmt.executeUpdate(sql);

            // second tour reservation
            sql = "INSERT INTO reservation (reservation_id) " +
                    "VALUES (null)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO customer_reserve (reservation_id, customer_id, acceptance_status) " +
                    "VALUES ( '6', '1','1')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_tour (reservation_id, tour_id, amount_of_people) " +
                    "VALUES ( '6', '2','5')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_tour_activity (user_id, tour_id, activity_id, count) " +
                    "VALUES ( '1', '2','1','3')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO reservation_tour_activity (user_id, tour_id, activity_id, count) " +
                    "VALUES ( '1', '2','2','4')";
            stmt.executeUpdate(sql);

            // third tour reservation
            sql = "INSERT INTO reservation (reservation_id) " +
                    "VALUES (null)";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO customer_reserve (reservation_id, customer_id, acceptance_status,reason) " +
                    "VALUES ( '7', '1','0','There is no more place in tour.')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_tour (reservation_id, tour_id, amount_of_people) " +
                    "VALUES ( '7', '6','3')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO reservation_tour_activity (user_id, tour_id, activity_id, count) " +
                    "VALUES ( '1', '6','1','2')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO reservation_tour_activity (user_id, tour_id, activity_id, count) " +
                    "VALUES ( '1', '6','2','4')";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO hotel_evaluation (evalutaion_id, hotel_id, rate, evaluation)" +
                    "VALUES ( null, '1', '5', 'Employees, rooms were really good.' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO hotel_evaluation (evalutaion_id, hotel_id, rate, evaluation)" +
                    "VALUES ( null, '1', '4', 'Good hotel but location is not so good.' )";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO city (city_id, city_name)" +
                    "VALUES ( null, 'Ankara' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO city (city_id, city_name)" +
                    "VALUES ( null, 'Istanbul' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO city (city_id, city_name)" +
                    "VALUES ( null, 'Paris' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO city (city_id, city_name)" +
                    "VALUES ( null, 'Roma' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO city (city_id, city_name)" +
                    "VALUES ( null, 'Denizli' )";
            stmt.executeUpdate(sql);

            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 1, 1 )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 2, 1 )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 3, 1 )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 1, 2 )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 4, 2 )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 1, 3 )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 1, 5 )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_city (city_id, tour_id)" +
                    "VALUES ( 1, 4 )";
            stmt.executeUpdate(sql);

            // System.out.println("------------------1----------------");
            // sql = "SELECT bdate,address,city " +
            // "FROM customer," +
            // "(SELECT MIN(wallet) as minwallet " +
            // "FROM customer) A " +
            // "WHERE customer.wallet=A.minwallet";
            // printSql(sql,stmt);

        } catch (SQLException e) {
            System.out.println("SQL Exception Happened:" + e.getMessage());
            // e.printStackTrace();
        }
    }

    public static void printSql(String sql, Statement stmt) throws SQLException {
        ResultSet rs = stmt.executeQuery(sql);
        ResultSetMetaData rsmd = rs.getMetaData();
        int columnsNumber = rsmd.getColumnCount();
        for (int i = 1; i <= columnsNumber; i++) {
            if (i == 1) {
                System.out.print(rsmd.getColumnName(i));
            } else {
                System.out.print(" | " + rsmd.getColumnName(i));
            }
        }
        while (rs.next()) {
            System.out.println();
            for (int i = 1; i <= columnsNumber; i++) {
                if (i == 1) {
                    System.out.print(rs.getString(i));
                } else {
                    System.out.print(", " + rs.getString(i));
                }
            }
        }
        System.out.println();
        rs.close();
    }
}