/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package DAO;


import Entidade.Coluna;
import Entidade.Rota;
import Entidade.Tabela;
import Entidade.Util;
import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.JAXBException;

/**
 *
 * @author ronney
 */
public class BoladaoDAO extends DAO
{
    public BoladaoDAO() throws JAXBException, IOException, SQLException
    {   
        super(Util.GetPropriedade("DB_HOST"),Util.GetPropriedade("DB_PORT"),Util.GetPropriedade("DB_DATABASE"),Util.GetPropriedade("DB_USERNAME"),Util.GetPropriedade("DB_PASSWORD"));
    }
    
    public List<Tabela> GetTabelas(String schema,String[] tabls,String abrv) throws Exception
    {
        List<Tabela> tabelas = new ArrayList<Tabela>();
        
        String query = "SELECT tb.TABLE_NAME "
                    + "FROM information_schema.TABLES tb "
                    + "WHERE tb.TABLE_SCHEMA = ? "
                    + "AND tb.TABLE_TYPE = 'BASE TABLE' ";
        
        if(tabls != null && tabls.length > 0)
        {
            String condicao = "";
            for(int x = 0; x < tabls.length; x++)
            {
                condicao += String.format("'%s'%s",tabls[x],(x+1 == tabls.length ? "" : ","));
            }
            
            query += String.format("AND tb.TABLE_NAME IN(%s)",condicao);
        }
        
        if(abrv != null && !abrv.isEmpty())
        {
            query += "AND tb.TABLE_NAME LIKE '"+ abrv +"%' ";
        }
        
        try
        {                        
            ResultSet rs = this.getDb().ExecuteQuery(query, schema);
            
            while(rs.next())
            {
                tabelas.add(new Tabela(Util.GetPropriedade("DB_CONNECTION"),schema,rs.getString("TABLE_NAME")));
            }
            
            rs.close();
          
            return tabelas;
        }
        catch(Exception ex)
        {
            throw ex;
        }
        finally
        {
            this.getDb().close();
        }
    }
    
    public List<Coluna> GetColunas(Tabela tabela) throws Exception
    {
        List<Coluna> colunas = new ArrayList<Coluna>();
        
        String query = "SELECT col.COLUMN_NAME,col.DATA_TYPE,col.COLUMN_KEY "
                     + "FROM information_schema.COLUMNS col "
                     + "WHERE col.TABLE_SCHEMA = ? "
                     + "AND col.TABLE_NAME = ?";
        
        try
        {
            ResultSet rs = this.getDb().ExecuteQuery(query, tabela.getSchema(),tabela.getNome());
            
            while(rs.next())
            {
                colunas.add(new Coluna(tabela,rs.getString("COLUMN_NAME"),rs.getString("DATA_TYPE"),rs.getString("COLUMN_KEY").equalsIgnoreCase("PRI"),rs.getString("COLUMN_KEY").equalsIgnoreCase("MUL")));
            }
            
            rs.close();
            
            return colunas;
        }
        catch(Exception ex)
        {
            throw ex;
        }
        finally
        {
            this.getDb().close();
        }
    }
    
    public Coluna GetForeignKey(Coluna coluna) throws Exception
    {
        Coluna foreignKey = null;
        
        String query = "SELECT FK.REFERENCED_TABLE_NAME,FK.REFERENCED_COLUMN_NAME "
                     + "FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE FK "
                     + "WHERE FK.TABLE_SCHEMA = ? "
                     + "AND FK.TABLE_SCHEMA = FK.REFERENCED_TABLE_SCHEMA "
                     + "AND FK.TABLE_NAME = ? "
                     + "AND FK.COLUMN_NAME = ? ";
        try
        {
            ResultSet rs = this.getDb().ExecuteQuery(query, coluna.getTabela().getSchema(),coluna.getTabela().getNome(),coluna.getNome());
            
            while(rs.next())
            {
                foreignKey = new Coluna(new Tabela(Util.GetPropriedade("DB_CONNECTION"),coluna.getTabela().getSchema(),rs.getString("REFERENCED_TABLE_NAME")),rs.getString("REFERENCED_COLUMN_NAME"),"",false,false);
            }
            
            rs.close();
            
            return foreignKey;
        }
        catch(Exception ex)
        {
            throw ex;
        }
        finally
        {
            this.getDb().close();
        }
    }
    
    public List<Coluna> GetReferencias(Coluna coluna) throws Exception
    {
        List<Coluna> referencia = new ArrayList();
        
        String query = "SELECT FK.TABLE_NAME,FK.COLUMN_NAME "
                     + "FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE FK "
                     + "WHERE FK.TABLE_SCHEMA = ? "
                     + "AND FK.TABLE_SCHEMA = FK.REFERENCED_TABLE_SCHEMA "
                     + "AND FK.REFERENCED_TABLE_NAME = ? "
                     + "AND FK.REFERENCED_COLUMN_NAME = ? ";
        try
        {
            ResultSet rs = this.getDb().ExecuteQuery(query, coluna.getTabela().getSchema(),coluna.getTabela().getNome(),coluna.getNome());
            
            while(rs.next())
            {
                referencia.add
                (
                    new Coluna
                    (
                        new Tabela
                        (
                            Util.GetPropriedade("DB_CONNECTION"),
                            coluna.getTabela().getSchema(),
                            rs.getString("TABLE_NAME")
                        ),
                        rs.getString("COLUMN_NAME"),"",false,true
                    )
                );
            }
            
            rs.close();
            
            return referencia;
        }
        catch(Exception ex)
        {
            throw ex;
        }
        finally
        {
            this.getDb().close();
        }
    }
    
    /*-------------------------- Rotas --------------------------*/
    public void InsereRota(Rota rota) throws Exception
    {
        String query = "INSERT INTO TBG_rotas(ROTA_nome,ROTA_rota,ROTA_menu,ROTA_FK_SIST_id,ROTA_FK_ROTA_id) "
                     + "SELECT * FROM " 
                     + "(SELECT ? ROTA_nome,? ROTA_rota,? ROTA_menu,(SELECT SIST_id FROM TBG_sistema WHERE SIST_codigo=? LIMIT 1) ROTA_FK_SIST_id,(SELECT ROTA_id FROM TBG_rotas WHERE ROTA_rota=? AND ROTA_FK_SIST_id=(SELECT SIST_id FROM TBG_sistema WHERE SIST_codigo=? LIMIT 1) LIMIT 1) ROTA_FK_ROTA_id) AS TMP "
                     + "WHERE NOT EXISTS(SELECT 1 FROM TBG_rotas WHERE ROTA_rota=? AND ROTA_FK_SIST_id=(SELECT SIST_id FROM TBG_sistema WHERE SIST_codigo=? LIMIT 1))";
                
        try
        {
            //insere rota
            this.getDb().ExecuteCommand(query,
                                        Util.primeiraMaiuscula(rota.getRotaPai()),
                                        rota.getRotaPai(),
                                        "1",
                                        Util.GetPropriedade("APP_SISTEMA"),
                                        rota.getRotaPai(),
                                        Util.GetPropriedade("APP_SISTEMA"),
                                        rota.getRotaPai(),
                                        Util.GetPropriedade("APP_SISTEMA"));
            
            //insere menu
            this.getDb().ExecuteCommand(query, 
                                        rota.getNome(),
                                        rota.getApelido(),
                                        rota.getHttp().equalsIgnoreCase("get"),
                                        Util.GetPropriedade("APP_SISTEMA"),
                                        rota.getRotaPai(),
                                        Util.GetPropriedade("APP_SISTEMA"),
                                        rota.getApelido(),
                                        Util.GetPropriedade("APP_SISTEMA"));
            
        }
        catch(Exception ex)
        {
            throw ex;
        }
        finally
        {
            this.getDb().close();
        }
    }
    

}
