package DAO;

import java.io.IOException;
import java.io.Serializable;

import javax.xml.bind.JAXBException;

public class DAO implements Serializable
{
    private static final long serialVersionUID = 7209921614490717838L;

    private DB db = null;

    public DAO(String servidor,String porta,String banco,String usuario, String senha) throws JAXBException, IOException
    {
        this.db = new DB("com.mysql.cj.jdbc.Driver", ("jdbc:mysql://"+servidor+":"+porta+"/" +banco+"?useTimezone=true&serverTimezone=UTC"), usuario,senha);
    }

    public DB getDb()
    {
        return db;
    }
    
    
}
