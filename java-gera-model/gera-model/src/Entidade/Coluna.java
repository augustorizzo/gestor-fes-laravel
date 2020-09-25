package Entidade;

import DAO.BoladaoDAO;
import Extensao.ColunaExtension;
import java.io.Serializable;
import java.util.List;

/**
 *
 * @author ronney
 */
public class Coluna implements Serializable
{
    private Tabela tabela;
    private String nome;
    private String tipo;
    private Boolean isPk;
    private Boolean isFk;
    private Coluna foreignKey;
    private List<Coluna> referencias;
    
    private String nomeVariavel;
    private String modelVariavel;
            
    public Coluna()
    {
    }
    
    public Coluna(String nome, String tipo, Boolean isPk, Boolean isFk)
    {
        this.nome = nome;
        this.tipo = tipo;
        this.isPk = isPk;
        this.isFk = isFk;
    }
    
    public Coluna(Tabela tabela,String nome, String tipo, Boolean isPk, Boolean isFk)
    {
        this.tabela = tabela;
        this.nome = nome;
        this.tipo = tipo;
        this.isPk = isPk;
        this.isFk = isFk;
    }

    
    public String getNomeVariavel() throws Exception
    {
        if(this.nomeVariavel == null)
        {
            this.nomeVariavel = ColunaExtension.NomeVariavel(this);
        }
        
        return  this.nomeVariavel;
    }
    
    public String getModelVariavel() throws Exception
    {
        if(this.modelVariavel == null)
        {
            this.modelVariavel = String.format("%s::$%s",this.tabela.getNomeArquivo(),this.getNomeVariavel());
        }
        
        return  this.modelVariavel;
    }
    
    public boolean IsTipoData()
    {
        return ("date,datetime,timestamp").contains(this.tipo);
    }
    
    public String GetMaskaraData()
    {
        String maskara = "";
        
        if(this.IsTipoData())
        {
            if(this.tipo.equalsIgnoreCase("date"))
            {
                maskara = "d/m/Y";
            }
            else if(this.tipo.equalsIgnoreCase("datetime") || this.tipo.equalsIgnoreCase("timestamp"))
            {
                maskara = "d/m/Y H:i:s";
            }
        }
        
        return maskara;
    }
    
    /*---------------------- GET / SET ----------------------*/
    public String getNome()
    {
        return nome;
    }

    public void setNome(String nome)
    {
        this.nome = nome;
    }

    public String getTipo()
    {
        return tipo;
    }

    public void setTipo(String tipo)
    {
        this.tipo = tipo;
    }   

    public Boolean isPk()
    {
        return isPk;
    }

    public void setIsPk(Boolean isPk)
    {
        this.isPk = isPk;
    }

    public Boolean isFk()
    {
        return isFk;
    }

    public void setIsFk(Boolean isFk)
    {
        this.isFk = isFk;
    }
    
    public Coluna getForeignKey() throws Exception
    {
        if(this.isFk() && this.foreignKey == null)
        {
            this.foreignKey = new BoladaoDAO().GetForeignKey(this);
        }
        
        return this.foreignKey;
    }
    
    public List<Coluna> getReferencias() throws Exception
    {
        if(this.isPk() && this.referencias == null)
        {
            this.referencias = new BoladaoDAO().GetReferencias(this);
        }
        
        return this.referencias;
    }
    
    public Tabela getTabela()
    {
        return tabela;
    }

    public void setTabela(Tabela tabela)
    {
        this.tabela = tabela;
    }
    
}
