package Entidade;

import DAO.BoladaoDAO;
import Extensao.ColunaExtension;
import Extensao.TabelaExtension;
import java.io.Serializable;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author ronney
 */
public class Tabela implements Serializable
{
    private String connection;
    private String schema;
    private String nome;
    private List<Coluna> colunas;
    private String arquivo;
    
    public Tabela()
    {
        
    }
    
    public Tabela(String connection,String schema,String nome)
    {
        this.connection = connection;
        this.schema = schema;
        this.nome = nome;
    }
    
    public Tabela(String schema,String nome,List<Coluna> colunas)
    {
        this.schema = schema;
        this.nome = nome;
        this.colunas = colunas;
    }
    
    public String getNomeArquivo()
    {
        if(this.arquivo == null || this.arquivo.isEmpty())
        {
            this.arquivo = TabelaExtension.nomeArquivo(this.nome);
        }
        
        return this.arquivo;
    }
    
    /* Model */
    public String GeraModel() throws Exception
    {                
        String campos = "",gets = "",sets = "",datas = "",constantes_datas = "",relations = "";
        
        //cria o GET da tabela
        gets += "\tpublic function getTabela(){return $this->$table;}\n";
        
        //percorre as colunas
        for(Coluna col : this.getColunas())
        {
            //cria a variável de datas
            if(col.IsTipoData())
            {
                //verifica a constante dt_cadastro
                if(col.getNome().contains("dt_criacao") || col.getNome().contains("dt_alteracao"))
                {
                    constantes_datas +=  String.format("\tconst %s = '%s';\n",(col.getNome().contains("dt_criacao") ? "CREATED_AT" : "UPDATED_AT"),col.getNome());
                }
                
                datas += (datas.length() > 1 ? "," : "") + String.format("'%s'",col.getNome());
            }
            
            //cria as variáveis dos campos
            campos += String.format
            (
                "\tpublic static $%s = '%s';\n",col.getNomeVariavel(),col.getNome()
            );
            
            //cria as funções GET's dos campos
            gets += String.format
            (
                "\tpublic function get%s(){"
                + "return " + (!col.IsTipoData() ? "$this->attributes[%s];" : "(new Carbon($this->attributes[%s]))->format('%s');")
                +"}\n",ColunaExtension.NomeCamelCase(col),col.getModelVariavel(),col.GetMaskaraData()
            );
            
            //cria as funções SET's dos campos
            sets += String.format
            (
                "\tpublic function set%s($valor){"
                + "$this->attributes[%s] = " + (!col.IsTipoData() ? "$valor;" : "Carbon::createFromFormat('%s',$valor);")
                + "}\n",ColunaExtension.NomeCamelCase(col),col.getModelVariavel(),col.GetMaskaraData()
            );
            
            //Cria os relacionamentos "belongsTo"
            if(col.isFk())
            {
                String modelId = col.getForeignKey().getTabela().getNomeArquivo();
                relations += String.format
                (
                    "\tpublic function %s(){return $this->belongsTo('App\\%s',%s);}\n",modelId,modelId,col.getModelVariavel()
                );
            }
            
            //Cria os relacionamentos "hasMany"
            if(col.isPk())
            {
                for(Coluna ref : col.getReferencias())
                {
                    String modelFk = ref.getTabela().getNomeArquivo();
                    
                    relations += String.format
                    (
                        "\tpublic function %s(){return $this->hasMany('App\\%s',%s);}\n",ColunaExtension.Plural(modelFk),modelFk,ref.getModelVariavel()
                    );
                }
            }
        }
        
        //cabeçalho do model
        String cabecalho = String.format
        (
            "<?php \n\n"
            + "namespace App;\n\n"
            + "use Illuminate\\Database\\Eloquent\\Model;"
            + (datas.length() > 0 ? "\nuse Carbon\\Carbon;" : "")
            + "\n\n"
            + "class %s extends Model\n"
            + "{\n",this.getNomeArquivo()
        );
        
        //configurações da tabela no arquivo
        String config = String.format
        (
            "\tprotected $connection = '%s';\n"
          + "\tprotected $table = '%s';\n"
          + "\tprotected $primaryKey = '%s';\n",this.getConnection(),this.getNome(),this.getPk().getNome()
        );
        
        //insere a variável de datas na configuração da tabela
        config += (datas.length() > 0 ? String.format("\tprotected $dates = [%s];\n",datas) : "");
        config += (constantes_datas.length() > 0 ? constantes_datas :"\tpublic $timestamps = false;\n");
        
        return 
        (
            cabecalho + config 
            + "\n\t//campos\n"+ campos 
            + (relations.length() > 0 ? ("\n\t//Relacionamentos\n" + relations) : "")
            + "\n\t//Get's\n" + gets 
            + "\n\t//Set's\n" + sets 
            + "\n}");
    }
    
    
    /*---------------------- GET / SET ----------------------*/
    public String getSchema()
    {
        return schema;
    }

    public void setSchema(String schema)
    {
        this.schema = schema;
    }

    public String getNome()
    {
        return nome;
    }

    public void setNome(String nome)
    {
        this.nome = nome;
    }

    public List<Coluna> getColunas() throws Exception
    {
        if(this.colunas == null)
        {
            this.colunas = new BoladaoDAO().GetColunas(this);
        }
        return colunas;
    }

    public void setColunas(List<Coluna> colunas)
    {
        this.colunas = colunas;
    }
    
    public Coluna getPk() throws Exception
    {
        Coluna pk = null; 
        for(Coluna col : this.getColunas())
        {
            if(col.isPk())
            {
                pk = col;
                break;
            }
        }
        
        return pk;
    }
    
    public List<Coluna> getFks() throws Exception
    {
        List<Coluna> fks = null;
        
        for(Coluna col : this.getColunas())
        {
            if(col.isFk())
            {
                if(fks == null){fks = new ArrayList<Coluna>();}
                fks.add(col);
            }
        }
        
        return fks;
    }

    public String getConnection()
    {
        return connection;
    }

    public void setConnection(String connection)
    {
        this.connection = connection;
    }
    
    
}
